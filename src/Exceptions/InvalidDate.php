<?php

namespace Rakibhstu\Banglanumber\Exceptions;

use Exception;

class InvalidDate extends Exception
{
    public function __construct()
    {
        parent::__construct('The given value is not a valid date.');
    }
}
