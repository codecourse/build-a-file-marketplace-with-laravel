<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        Str::macro('possessive', function ($string) {
            if (Str::endsWith($string, ['s', 'S'])) {
                return $string . '\'';
            }

            return $string . '\'s';
        });
    }
}
