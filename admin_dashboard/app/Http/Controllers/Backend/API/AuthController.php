<?php
namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ApiResponse;
    // REGISTER
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return $this->successResponse([
            'user'  => $user,
            'token' => $token,
        ], 'User registered successfully', 201);
    }

    // LOGIN
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        return $this->successResponse([
            'user'  => auth('api')->user(),
            'token' => $token,
        ], 'Login successful');
    }

    // LOGOUT
    public function logout()
    {
        auth('api')->logout();
        return $this->successResponse(null, 'Successfully logged out');
    }

    // REFRESH TOKEN
    public function refresh()
    {
        $token = auth('api')->refresh();
        return $this->successResponse(['token' => $token], 'Token refreshed successfully');
    }

    // PASSWORD RESET REQUEST
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? $this->successResponse(null, __($status))
            : $this->errorResponse(__($status), 400);
    }

    // PASSWORD RESET (JWT authenticated)
    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user           = User::find(auth('api')->id());
        $user->password = Hash::make($request->password);
        $user->save();

        return $this->successResponse(null, 'Password successfully updated');
    }
}
