<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        //
        if (env('APP_ENV') === 'local' && str_ends_with(request()->getHost(), '.ngrok-free.app')) {
            URL::forceScheme('https');
        }
    }
}
