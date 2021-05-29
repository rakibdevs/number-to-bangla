<?php

namespace Rakibhstu\Banglanumber\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rakibhstu\Banglanumber\NumberToBangla
 */

class NumberToBangla extends Facade
{
	protected static function getFacadeAccessor(): string
    {
        return 'bangla-number';
    }
}