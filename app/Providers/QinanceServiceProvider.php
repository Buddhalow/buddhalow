<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\Qinance;


class QinanceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->api_key = config('qinance.api_key');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Library\Services\Contracts\Qinance', function ($app) {
            return new Qinance($app['config']['qinance']);
        });
        $this->app->bind('App\Library\Services\Contracts\QinanceInterface', function($app)
        {
            return new Qinance($app['config']['qinance']);
        });
    }
}
