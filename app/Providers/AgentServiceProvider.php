<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Agent;

class AgentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('public', function ($view, $data) {
            $agent = new Agent();
            if ($agent->isMobile())
                return view('public.mobile.'.$view, $data);
            return view('public.desktop.'.$view, $data);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
