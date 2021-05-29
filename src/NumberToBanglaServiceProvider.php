<?php

namespace Rakibhstu\Banglanumber;

use Illuminate\Support\ServiceProvider;
use Rakibhstu\Banglanumber\NumberToBangla;

class NumberToBanglaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NumberToBangla::class);
        
        $this->app->alias(NumberToBangla::class, 'bangla-number');
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
