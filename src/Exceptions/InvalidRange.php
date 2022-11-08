<?php

namespace Rakibhstu\Banglanumber\Exceptions;

use Exception;

class InvalidRange extends Exception
{
    /**
     * @param $max
     * @return static
     */
	public static function message($max = 999999999999999)
	{
		return new static("The given value is not in valid range. Maximum accepted value is " . $max);
	}
}
