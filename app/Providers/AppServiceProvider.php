<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // User::setStripeKey('sk_test_jXm0F0ryCL9ia8Upi4hPWiJS00ARMo8JK4');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
