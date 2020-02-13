<?php

namespace Rakibhstu\Banglanumber;

use Illuminate\Support\ServiceProvider;

class NumberToBanglaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Rakibhstu\Banglanumber\NumberToBangla');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
