<?php

namespace App\Providers;

use TusPhp\Tus\Server as TusServer;
use Illuminate\Support\ServiceProvider;

class TusServiceProvider extends ServiceProvider
{   

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tus-server', function ($app) {
            $server = new TusServer('redis');

            $server
                ->setApiPath('/tus') // tus server endpoint.
                ->setUploadDir(public_path('uploads')); // uploads dir.
            
            $server->middleware()->skip(Cors::class);

            return $server;
        });
    }

}