<?php

namespace Rakibhstu\Banglanumber\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rakibhstu\Banglanumber\NumberToBangla
 */

class NumberToBanglaFacade extends Facade
{
    /**
     * @return string
     */
	protected static function getFacadeAccessor(): string
    {
        return 'number-to-bangla';
    }
}
