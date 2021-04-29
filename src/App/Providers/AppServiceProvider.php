<?php

namespace App\Providers;

use Domain\Shop\Basket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('basket', Basket::class);
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator): bool {
            return Hash::check($value, optional(auth('shop')->user())->password);
        });
    }
}
