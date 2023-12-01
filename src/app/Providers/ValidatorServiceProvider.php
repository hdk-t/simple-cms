<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('is_login_success', function ($attribute, $value, $parameters, $validator) {
            return strcmp($value, config('admin.admin_password')) === 0;
        });
    }
}
