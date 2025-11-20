<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller {
    /**
     * Display the user's profile settings page.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) {
        $user = User::find($request->id);
        return view('backend.layouts.settings.profile_settings', compact('user'));
    }

    /**
     * Update the user's profile.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function UpdateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'nullable|max:100|min:2',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            // 'payment_email' => 'required|unique:users,payment_email,' . auth()->user()->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $user = Auth::user();

            if ($user->role !== 'admin') {
                return redirect()->back()->with('error', 'You are not authorized to access this page');
            }

            // Update user profile
            $user->name = $request->name ?? $user->name;
            $user->email = $request->email;
            // $user->payment_email = $request->payment_email;
            $user->save();

            // Update .env file
           /*  $this->updateEnv([
                'PAYPAL_ADMIN_EMAIL' => $request->payment_email,
            ]); */

            // Clear cache for changes to take effect
            // Artisan::call('config:clear');

            return redirect()->back()->with('t-success', 'Profile updated successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }

    /**
     * Update the user's password.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function UpdatePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password'     => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $user = Auth::user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('t-success', 'Password updated successfully');
            } else {
                return redirect()->back()->with('t-error', 'Current password is incorrect');
            }
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }

    /**
     * Update the user's profile picture.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function UpdateProfilePicture(Request $request) {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        try {
            $user      = Auth::user();
            $image     = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            //? Check if there's an existing profile picture
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                Helper::fileDelete(public_path($user->avatar));
            }

            //* Use the Helper class to handle the file upload
            $imagePath = Helper::fileUpload($image, 'profile', $imageName);

            if ($imagePath === null) {
                throw new Exception('Failed to upload image.');
            }

            //! Update user's avatar with the new image path
            $user->avatar = $imagePath;
            $user->save();

            return response()->json([
                'success'   => true,
                'image_url' => asset($imagePath),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    // Private function to update .env datas
    private function updateEnv($data)
    {
        $envPath = base_path('.env');

        if (File::exists($envPath)) {
            $envContent = File::get($envPath);

            foreach ($data as $key => $value) {
                $pattern = "/^{$key}=.*/m";
                $replacement = "{$key}={$value}";

                if (preg_match($pattern, $envContent)) {
                    $envContent = preg_replace($pattern, $replacement, $envContent);
                } else {
                    $envContent .= "\n{$key}={$value}";
                }
            }

            File::put($envPath, $envContent);
        }
    }

}
