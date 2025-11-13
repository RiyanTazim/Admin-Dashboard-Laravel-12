<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Web\Backend\AdminController;
use App\Http\Controllers\Web\Backend\AddUserController;
use App\Http\Controllers\Web\Backend\DynamicPageController;
use App\Http\Controllers\Web\Backend\SocialMediaController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\MailSettingController;
use App\Http\Controllers\Web\Backend\Settings\StripeSettingController;
use App\Http\Controllers\Web\Backend\Settings\SystemSettingController;

Route::middleware([AdminMiddleware::class])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    //route for Dynamic page
    Route::controller(DynamicPageController::class)->group(function () {
        Route::get('/dynamic', 'index')->name('dynamic.index');
        Route::get('/dynamic/create', 'create')->name('dynamic.create');
        Route::post('/dynamic/store', 'store')->name('dynamic.store');
        Route::get('/dynamic/edit/{id}', 'edit')->name('dynamic.edit');
        Route::get('/dynamic/show/{id}', 'show')->name('dynamic.show');
        Route::post('/dynamic/update/{id}', 'update')->name('dynamic.update');
        Route::get('/dynamic/status/{id}', 'status')->name('dynamic.status');
        Route::delete('/dynamic/delete/{id}', 'destroy')->name('dynamic.destroy');
    });

    //! Route for Profile Settings
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.setting');
        Route::patch('/update-profile', 'UpdateProfile')->name('update.profile');
        Route::put('/update-profile-password', 'UpdatePassword')->name('update.Password');
        Route::post('/update-profile-picture', 'UpdateProfilePicture')->name('update.profile.picture');
    });

    //! Route for System Settings
    Route::controller(SystemSettingController::class)->group(function () {
        Route::get('/system-setting', 'index')->name('system.index');
        Route::patch('/system-setting', 'update')->name('system.update');
    });

    //! Route for Mail Settings
    Route::controller(MailSettingController::class)->group(function () {
        Route::get('/mail-setting', 'index')->name('mail.setting');
        Route::patch('/mail-setting', 'update')->name('mail.update');
    });

    //! Route for Stripe Settings
    Route::controller(StripeSettingController::class)->group(function () {
        Route::get('/stripe-setting', 'index')->name('stripe.index');
        Route::get('/google-setting', 'google')->name('google.index');
        Route::patch('/credentials-setting', 'update')->name('credentials.update');
    });

        //!Route for Add user
    Route::controller(AddUserController::class)->group(function () {
        Route::get('/users/list', 'index')->name('users.index');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('/users/store', 'store')->name('users.store');
        Route::get('/users/show/{id}', 'show')->name('users.show');
        Route::get('/users/edit/{id}', 'edit')->name('users.edit');
        Route::put('/users/update/{id}', 'update')->name('users.update');
        Route::get('/users/status/{id}', 'status')->name('users.status');
        Route::delete('/users/delete/{id}', 'destroy')->name('users.destroy');
    });

        //!Route for Social Media
    Route::controller(SocialMediaController::class)->group(function () {
        Route::get('/social/media/list', 'index')->name('social.index');
        Route::get('/social/media/create', 'create')->name('social.create');
        Route::post('/social/media/store', 'store')->name('social.store');
        Route::get('/social/media/edit/{id}', 'edit')->name('social.edit');
        Route::put('/social/media/update/{id}', 'update')->name('social.update');
        Route::get('/social/media/status/{id}', 'status')->name('social.status');
        Route::delete('/social/media/delete/{id}', 'destroy')->name('social.destroy');
    });
});
