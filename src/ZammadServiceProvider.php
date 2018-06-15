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
        $this->app->bind('zammad.client', function()
        {
          $client = new Client([
            'url'           => env('ZAMMAD_URL'), // URL to your Zammad installation
            'username'      => env('ZAMMAD_USERNAME'),  // Username to use for authentication
            'password'      => env('ZAMMAD_PASSWORD'),           // Password to use for authentication
          ]);

	  return $client;
        });

        $this->app->bind('zammad', function()
        {
            return new \Muhammadn\ZammadLaravel\Zammad;
        });
    }
}
