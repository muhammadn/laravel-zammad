<?php

namespace Muhammadn\ZammadLaravel;

use Illuminate\Support\ServiceProvider;
use ZammadAPIClient\Client;

class ZammadServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('zammad', function()
        {
            return new \Muhammadn\ZammadLaravel\Zammad;
        });
    }
}
