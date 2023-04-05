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
        $this->app->singleton(NumberToBangla::class, function ($app) {
            return new NumberToBangla(
                $app->make(ProcessNumber::class),
                $app->make(ProcessDate::class)
            );
        });

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
