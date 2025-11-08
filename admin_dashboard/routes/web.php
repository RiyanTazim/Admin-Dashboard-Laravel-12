<?php

use App\Http\Controllers\Backend\Web\AdminController;
use App\Http\Controllers\Backend\Web\SystemSettingsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('Backend/master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::get('/profile/destroy', [ProfileController::class, 'destroy'])->name('logout');

    Route::controller(AdminController::class)->group(function () {
        Route::get('/profile', 'index')->name('admin.index');
        Route::post('/profile/update', 'updateProfile')->name('admin.updateProfile');
        Route::post('/profile/update/password', 'updatePassword')->name('admin.updatePassword');
        Route::post('/profile/update/profile-picture', 'updateProfilePicture')->name('admin.updateProfilePicture');

        Route::get('/system', 'systemIndex')->name('system.index');
        Route::post('/system/settings', 'systemSettings')->name('system.settings');
    });

    Route::controller(SystemSettingsController::class)->group(function () {
        Route::get('/system', 'systemIndex')->name('system.index');
        Route::post('/system/settings', 'systemSettings')->name('system.settings');
    });
});

require __DIR__.'/auth.php';
