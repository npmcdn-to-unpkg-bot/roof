<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Agent;
use Response;

class AgentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('general', function ($view, array $data = array()) {
            if (Agent::isMobile())
                return view('general.mobile.'.$view, $data);
            return view('general.desktop.'.$view, $data);
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
