<?php

namespace Rakibhstu\Banglanumber;

use Illuminate\Support\ServiceProvider;
use Rakibhstu\Banglanumber\Facades\NumberToBanglaFacade;

class NumberToBanglaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NumberToBangla::class, function ($app) {
            return new NumberToBangla(
                $app->make(ProcessNumber::class),
                $app->make(ProcessDate::class)
            );
        });

        $this->app->singleton('number-to-bangla', NumberToBangla::class);

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
