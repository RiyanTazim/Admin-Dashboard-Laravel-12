<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Authentication\AuthController;


// Route::prefix('auth')->group(function () {
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('login', [AuthController::class, 'login']);

//     // Password reset
//     Route::post('password/email', [AuthController::class, 'sendResetLinkEmail']);
//     Route::post('password/reset', [AuthController::class, 'reset']);
// });

// // Protected routes (require JWT token)
// Route::middleware(['auth:api'])->group(function () {
//     Route::post('auth/logout', [AuthController::class, 'logout']);
//     Route::post('auth/refresh', [AuthController::class, 'refresh']);

//     // Example: get authenticated user
//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     });

// });


Route::prefix('auth')->group(function () {
    // Password reset
    Route::post('password/email', [AuthController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [AuthController::class, 'reset']);
});


require __DIR__ . '/tazimApi.php';