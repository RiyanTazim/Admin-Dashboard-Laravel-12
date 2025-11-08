<?php

namespace App\Providers;

use App\Models\SystemSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use PHPUnit\Event\Telemetry\System;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
          View::composer('*', function ($view) {
            $settings = SystemSettings::first();
            $view->with('settings', $settings);
        });
    }
}
