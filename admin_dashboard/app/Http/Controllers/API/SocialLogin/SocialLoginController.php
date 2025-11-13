<?php

namespace App\Http\Controllers\API\SocialLogin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class SocialLoginController extends Controller
{
    public function SocialLogin(Request $request)
    {
        // Custom validation
        $validator = Validator::make($request->all(), [
            'provider' => 'required|in:google,facebook',
            'token' => 'required',
        ]);

        // If validation fails, return custom error response using Helper::jsonErrorResponse
        if ($validator->fails()) {
            return Helper::jsonErrorResponse('Validation Failed', 422, ['errors' => $validator->errors()]);
        }

        try {
            // provider = google or facebook
            $socialUser = Socialite::driver($request->provider)->stateless()->userFromToken($request->token);

            if ($socialUser) {
                // Check if user exists in the database
                $user = User::where('email', $socialUser->getEmail())->first();

                if (!$user) {
                    // Generate a random password
                    $password = Str::random(16);

                    // Create new user
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'avatar' => $socialUser->getAvatar(),
                        'email_verified_at' => Carbon::now(),  // Setting email_verified_at to current time
                        'password' => Hash::make($password),
                        $request->provider . '_id' => $socialUser->getId(), // google_id or facebook_id
                    ]);
                }

                // Generate JWT token
                $token = JWTAuth::fromUser($user);
                // $token = $user->createToken('auth_token')->plainTextToken; // For Laravel Sanctum
                // Fetch latest assessment score
                $latestAssessment = $user->assessments()->latest()->first();
                $user->assessment_score = $latestAssessment ? $latestAssessment->score : null;

                // Return success response using Helper::jsonResponse
                return response()->json([
                    'success' => true,
                    'message' => "Login Successfully via " . ucfirst($request->provider),
                    'data' => [
                        'token' => $token,
                        'user' => $user,
                    ],
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Invalid or Expired Token",
                ], 422);
            }
        } catch (Exception $e) {
            // Return error response using Laravel default json response in case of exception
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
