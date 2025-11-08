<?php
namespace App\Http\Controllers\Backend\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        return view('Backend.Layout.admin.profile');
    }

    /**
     * Update user profile (name, username, email, avatar)
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        try {
            DB::transaction(function () use ($user, $validated) {
                $user->update([
                    'username' => $validated['username'],
                    'name'     => $validated['name'],
                    'email'    => $validated['email'],
                ]);
            });

            return redirect()->back()->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            Log::error('Profile update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update profile. Please try again.');
        }
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        try {
            DB::transaction(function () use ($request, $user) {
                $avatarFile = $request->file('avatar');
                $filename   = uniqid('user_') . '.' . $avatarFile->getClientOriginalExtension();
                $uploadPath = public_path('images/users');

                if (! file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                // Delete old avatar if exists
                if ($user->avatar && File::exists(public_path($user->avatar))) {
                    File::delete(public_path($user->avatar));
                }

                // Move new file
                $avatarFile->move($uploadPath, $filename);
                $user->avatar = 'images/users/' . $filename;
                $user->save();
            });

            return response()->json([
                'success'   => true,
                'message'   => 'Image uploaded successfully.',
                'image_url' => asset($user->avatar),
            ]);

        } catch (\Exception $e) {
            Log::error('Avatar upload failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image.',
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'old_password' => 'required',
            'password'     => 'required|min:8|confirmed',
        ]);

        if (! Hash::check($validated['old_password'], $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Your current password is incorrect.'])->with('type', 'password');
        }

        DB::transaction(function () use ($user, $validated) {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);
        });

        return redirect()->back()->with('success', 'Password updated successfully!')->with('type', 'password');
    }

    public function systemIndex()
    {
        return view('Backend.Layout.admin.systemSetting');
    }

    public function systemSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'system_title'       => 'required|string|max:150',
            'system_short_title' => 'nullable|string|max:100',
            'tag_line'           => 'nullable|string|max:255',
            'company_name'       => 'required|string|max:150',
            'phone_code'         => 'required|string|max:5',
            'phone_number'       => 'required|string|max:15|regex:/^\d+$/',
            'email'              => 'required|email|max:150',
            'copyright'          => 'nullable|string|max:500',
        ],
            [
                'system_title.required' => 'The system title is required.',
                'system_title.max'      => 'The system title must not exceed 150 characters.',
                'company_name.required' => 'The company name is required.',
                'phone_code.required'   => 'The phone code is required.',
                'phone_number.required' => 'The phone number is required.',
                'phone_number.regex'    => 'The phone number must contain only digits.',
                'email.required'        => 'The email is required.',
                'email.email'           => 'Enter a valid email address.',
            ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        try {
            $setting = User::firstOrNew();

            if (! $setting) {
                $setting = new User();
            }

            $setting->system_title       = Str::title($request->system_title);
            $setting->system_short_title = $request->system_short_title;
            $setting->tag_line           = $request->tag_line;
            $setting->company_name       = $request->company_name;
            $setting->phone_code         = $request->phone_code;
            $setting->phone_number       = $request->phone_number;
            $setting->email              = $request->email;

            // Handle logo
            if ($request->hasFile('logo')) {
                if (! empty($setting->logo) && file_exists(public_path($setting->logo)) && $setting->logo != 'uploads/systems/logo/logo.png') {
                    unlink(public_path($setting->logo));
                }

                $logoPath = public_path('uploads/systems/logo');
                if (! file_exists($logoPath)) {
                    mkdir($logoPath, 0775, true);
                }

                $file     = $request->file('logo');
                $filename = time() . '_logo.' . $file->getClientOriginalExtension();
                $file->move($logoPath, $filename);

                $setting->logo = 'uploads/systems/logo/' . $filename;
            }

            // Handle favicon
            if ($request->hasFile('favicon')) {
                if (! empty($setting->favicon) && file_exists(public_path($setting->favicon)) && $setting->favicon != 'uploads/systems/favicon/favico.png') {
                    unlink(public_path($setting->favicon));
                }

                $faviconPath = public_path('uploads/systems/favicon');
                if (! file_exists($faviconPath)) {
                    mkdir($faviconPath, 0775, true);
                }

                $file     = $request->file('favicon');
                $filename = time() . '_favicon.' . $file->getClientOriginalExtension();
                $file->move($faviconPath, $filename);

                $setting->favicon = 'uploads/systems/favicon/' . $filename;
            }

            // $setting->fill($data);
            // $setting->update($data);
            $setting->save();

            return redirect()->back()->with('success', 'Update information successfully');

        } catch (\Exception $e) {
            Log::error('System settings update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update system settings. Please try again.');
        }

    }
}
