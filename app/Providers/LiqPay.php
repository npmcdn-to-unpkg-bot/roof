<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LiqPay extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require base_path('vendor/liqpay/liqpay/LiqPay.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('liqpay', function($app)
            {
                return new \vendor\liqpay\liqpay\LiqPay();
            });
    }
}
