<?php

namespace Rakibhstu\Banglanumber\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Rakibhstu\Banglanumber\NumberToBanglaServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            NumberToBanglaServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'NumberToBangla' => \Rakibhstu\Banglanumber\NumberToBangla::class,
        ];
    }
}
