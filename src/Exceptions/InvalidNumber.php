<?php

namespace Rakibhstu\Banglanumber\Exceptions;

use Exception;

class InvalidNumber extends Exception
{
    public function __construct()
	{
		parent::__construct('The given value is not a valid number.');
	}
}
