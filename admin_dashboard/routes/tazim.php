<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    // License Type
    // Route::controller(LicenseTypeController::class)->prefix('license')->group(function () {

    //     Route::get('/index', 'index')->name('licensetype.index');
    //     Route::get('/create', 'create')->name('licensetype.create');
    //     Route::post('/store', 'store')->name('licensetype.store');
    //     Route::get('/edit/{id}', 'edit')->name('licensetype.edit');
    //     Route::post('/update/{id}', 'update')->name('licensetype.update');
    //     Route::get('/status/{id}', 'status')->name('licensetype.status');
    //     Route::delete('/delete/{id}', 'delete')->name('licensetype.destroy');
    // });
});
