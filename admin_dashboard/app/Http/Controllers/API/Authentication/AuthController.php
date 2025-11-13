<?php

namespace App\Http\Controllers\API\Authentication;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\PasswordResetMail;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ForgotPassword;
use Illuminate\Support\Facades\Password;
use App\Notifications\CommonNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Custom validation rules
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // If validation fails, return the errors with a 422 Unprocessable Entity status code
        if ($validator->fails()) {
            return Helper::jsonErrorResponse('Profile Update Validation failed', 422, $validator->errors()->toArray());
        }

        // Retrieve credentials from the validated data
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate using JWTAuth
        $token = JWTAuth::attempt($credentials);

        // If token is not generated, return an unauthorized error
        if (!$token) {
            return Helper::jsonErrorResponse('Unauthorized', 401);
        }

        // Fetch the authenticated user using JWTAuth
        $user = JWTAuth::user();

        // Fetch latest assessment score
        $latestAssessment = $user->assessments()->latest()->first();

        // Return successful login response with user details and token
        return Helper::jsonResponse(true, 'Login Successfully', 200, [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'avatar' => $user->avatar,
                'phone' => $user->phone,
                'premium' => $user->is_premium,
                'assessment_score' => $latestAssessment ? $latestAssessment->score : null
            ],
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
    // User Registration with jwt token generation for auto login
    public function register(Request $request)
    {
        // Custom validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // If validation fails, return a 422 Unprocessable Entity response with errors
        if ($validator->fails()) {
            return Helper::jsonErrorResponse('Registration Validation failed', 422, $validator->errors()->toArray());
        }

        // Create the user record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing the password
        ]);

        // Send welcome notification (using Queue) after user registration
        $user->notify(new CommonNotification('Registration successfully done!!. Welcome to our App!'));


        // Fetch latest assessment score
        $latestAssessment = $user->assessments()->latest()->first();
        // Generate the JWT token for the user
        $token = JWTAuth::fromUser($user);

        // Return success response with user data and JWT token
        return Helper::jsonResponse(true, 'Registration successfully done', 201, [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'avatar' => $user->avatar,
                'phone' => $user->phone,
                'premium' => $user->is_premium,
                'assessment_score' => $latestAssessment ? $latestAssessment->score : null
            ],
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }


    /* public function register(Request $request)
    {
        // Custom validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // If validation fails, return a 422 Unprocessable Entity response with errors
        if ($validator->fails()) {
            return Helper::jsonErrorResponse('Profile Update Validation failed', 422, $validator->errors()->toArray());
        }

        // Create the user record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing the password
        ]);

        // Generate the JWT token for the user
        // $token = JWTAuth::fromUser($user);

        // Return success response with user data and JWT token
        return Helper::jsonResponse(true, 'Registration successfully done', 201, $user);
    } */


    public function logout()
    {
        $user = JWTAuth::user();
        JWTAuth::invalidate(JWTAuth::getToken());
        return Helper::jsonResponse(true, 'Successfully logged out', 200, [
            'user name' => $user->name,
        ]);
    }


    //for new token create
    public function refresh()
    {
        $newToken = JWTAuth::refresh(JWTAuth::getToken());
        return Helper::jsonResponse(true, 'New token generated', 200, [
            'user' => [
                'id' => JWTAuth::user()->id,
                'name' => JWTAuth::user()->name,
                'email' => JWTAuth::user()->email,
                'avatar' => JWTAuth::user()->avatar,
                'role' => JWTAuth::user()->role,
                'phone' => JWTAuth::user()->phone,
            ],
            'authorisation' => [
                'token' => $newToken,
                'type' => 'bearer',
            ]
        ]);
    }

    //Account Delete functions
    public function deleteAccount(Request $request)
    {
        $user = $request->user();

        // Revoke all tokens before deleting the account
        $user->tokens()->delete();

        // Delete the user account
        $user->delete();

        return Helper::jsonResponse(true, 'Account deleted successfully', 200, ['user name' => $user->name]);
    }

    /* public function ProfileUpdate(Request $request)
    {
        // Get the currently authenticated user
        $authenticatedUser = User::find(auth()->user()->id);

        // Custom validation rules for profile update
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $authenticatedUser->id,
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp,ico,bmp,tiff|max:2048',
            'address' => 'nullable|string|max:255'
        ]);

        // If validation fails, return a 422 response with error messages
        if ($validator->fails()) {
            return Helper::jsonErrorResponse('Profile Update Validation failed', 422, $validator->errors()->toArray());
        }

        // Update the user's profile information
        $authenticatedUser->name = $request->name;
        $authenticatedUser->email = $request->email;
        $authenticatedUser->address = $request->address;

        // Handle avatar upload if there's a new avatar
        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists
            if ($authenticatedUser->avatar) {
                Helper::fileDelete(public_path($authenticatedUser->avatar));
            }

            // Upload new avatar using the Helper::fileUpload method
            $avatar = $request->file('avatar');
            $avatarName = $authenticatedUser->id . '_avatar'; // Use user ID for uniqueness
            $avatarPath = Helper::fileUpload($avatar, 'profile/avatar', $avatarName);

            // Save the path of the avatar in the database
            $authenticatedUser->avatar = $avatarPath;
        }

        // Save the updated user data
        $authenticatedUser->save();

        // Return success response with the updated user data
        return Helper::jsonResponse(true, 'Profile updated successfully', 200, $authenticatedUser->only(['name', 'email', 'avatar', 'address']));
    } */
    public function ProfileUpdate(Request $request)
    {
        $authenticatedUser = User::find(auth()->user()->id);

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|nullable|string|max:255',
            'email' => 'sometimes|nullable|email|max:255|unique:users,email,' . $authenticatedUser->id,
            'avatar' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,svg,webp,ico,bmp,tiff|max:5120',
            'address' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|nullable|string|max:17',
            'birth_date' => 'sometimes|nullable|date',
        ]);

        if ($validator->fails()) {
            return Helper::jsonErrorResponse(
                'Profile Update Validation failed',
                422,
                $validator->errors()->toArray()
            );
        }

        // Update only the fields that exist in request
        if ($request->filled('name')) {
            $authenticatedUser->name = $request->name;
        }

        if ($request->filled('email')) {
            $authenticatedUser->email = $request->email;
        }

        if ($request->filled('address')) {
            $authenticatedUser->address = $request->address;
        }
        if ($request->filled('phone')) {
            $authenticatedUser->phone = $request->phone;
        }
        if ($request->filled('birth_date')) {
            $authenticatedUser->birth_date = $request->birth_date;
        }

        // Avatar handle
        if ($request->hasFile('avatar')) {
            if ($authenticatedUser->avatar) {
                Helper::fileDelete(public_path($authenticatedUser->avatar));
            }

            $avatar = $request->file('avatar');
            $avatarName = $authenticatedUser->id . '_avatar';
            $avatarPath = Helper::fileUpload($avatar, 'profile/avatar', $avatarName);

            $authenticatedUser->avatar = $avatarPath;
        }

        $authenticatedUser->save();

        return Helper::jsonResponse(
            true,
            'Profile updated successfully',
            200,
            $authenticatedUser->only(['name', 'email', 'avatar', 'address', 'phone', 'birth_date'])
        );
    }


    // password change
    public function ChangePassword(Request $request)
    {
        // Create custom validator using Validator facade
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return Helper::jsonErrorResponse('Profile Update Validation failed', 422, $validator->errors()->toArray());
        }

        // Authenticate the user using JWT
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return Helper::jsonErrorResponse('User not found or unauthorized', 401);
        }

        // Check if the old password matches the current password
        if (!Hash::check($request->old_password, $user->password)) {
            return Helper::jsonErrorResponse('Old password is incorrect', 400);
        }

        // Hash the new password and save it to the database
        $user->password = Hash::make($request->password);
        $user->save();

        return Helper::jsonResponse(true, 'Password changed successfully', 200, $user->only(['name', 'email', 'avatar']));
    }



    // Forgot Password API - send OTP to email
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return Helper::jsonErrorResponse('Profile Update Validation failed', 422, $validator->errors()->toArray());
        }

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return Helper::jsonErrorResponse('No user found with this email address.', 404);
        }

        // Generate a 6-digit reset token
        $token = rand(100000, 999999);

        // Store the token and expiry time in the database
        $user->password_reset_token = $token;
        $user->password_reset_token_expiry = now()->addMinutes(5);  // Token expires after 5 minutes
        $user->save();

        // Send token to the user's email (using Queue)
        Mail::to($user->email)->queue(new PasswordResetMail($token));

        return Helper::jsonResponse(true, 'Password reset OTP has been sent to your email.', 200, []);
    }



    // OTP Verification API - Verify OTP sent to email
    public function verifyOtp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return Helper::jsonErrorResponse('Profile Update Validation failed', 422, $validator->errors()->toArray());
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return Helper::jsonErrorResponse('No user found with this email address.', 404);
        }

        // Check if the OTP matches
        if ($user->password_reset_token !== $request->otp) {
            return Helper::jsonErrorResponse('Invalid OTP.', 400);
        }

        // Check if the OTP has expired
        if ($user->password_reset_token_expiry < now()) {
            return Helper::jsonErrorResponse('OTP has expired.', 400);
        }

        // OTP is valid, proceed to allow password reset
        return Helper::jsonResponse(true, 'OTP verified successfully. You can now reset your password.', 200);
    }



    // Password Reset API - Reset user password
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return Helper::jsonErrorResponse('Profile Update Validation failed', 422, $validator->errors()->toArray());
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return Helper::jsonErrorResponse('No user found with this email address.', 404);
        }

        // Check if OTP verification is done
        if ($user->password_reset_token === null || $user->password_reset_token_expiry < now()) {
            return Helper::jsonErrorResponse('OTP verification failed or expired. Please request a new OTP.', 400);
        }

        // If OTP is verified and not expired, proceed with password reset
        $user->password = Hash::make($request->password); // Hash the new password
        $user->password_reset_token = null; // Clear the token after password reset
        $user->password_reset_token_expiry = null; // Clear the expiry
        $user->save();

        return Helper::jsonResponse(true, 'Password has been successfully reset.', 200);
    }


    // Resend OTP API - resend OTP to email if expired or not sent previously
    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return Helper::jsonErrorResponse('Profile Update Validation failed', 422, $validator->errors()->toArray());
        }

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return Helper::jsonErrorResponse('No user found with this email address.', 404);
        }

        // Generate a new 6-digit reset token
        $token = rand(100000, 999999);

        // Store the new token and set expiry time
        $user->password_reset_token = $token;
        $user->password_reset_token_expiry = now()->addMinutes(5);  // Token expires after 5 minutes
        $user->save();

        // Send the new token to the user's email
        Mail::to($user->email)->queue(new PasswordResetMail($token));

        return Helper::jsonResponse(true, 'A new password reset OTP has been sent to your email.', 200, []);
    }


    // User Profile Retrieval API

    public function profileRetrieval(Request $request)
    {
        try {
            $user = auth()->user();

            // Latest assessment with both score and created_at
            $latestAssessment = $user->assessments()->latest()->first();

            $latestCreatedAt = $latestAssessment
                // ? Carbon::parse($latestAssessment->created_at)->format('d F Y, g:i A')
                ? Carbon::parse($latestAssessment->updated_at)->format('d F Y, g:i A')
                : null;

            return Helper::jsonResponse(
                true,
                'User profile retrieved successfully.',
                200,
                $user->only(['id', 'name', 'email', 'avatar', 'address', 'phone', 'role', 'is_premium', 'birth_date']) + [
                    'ossd_score'      => optional($latestAssessment)->score,
                    'ossd_created_at' => $latestCreatedAt,
                ]
            );
        } catch (Exception $e) {
            return Helper::jsonErrorResponse('Failed to retrieve user profile.', 500);
        }
    }
}
