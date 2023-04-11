<?php

namespace Rakibhstu\Banglanumber\Exceptions;

use Exception;

class InvalidRange extends Exception
{
    public function __construct($max = 999999999999999)
    {
        parent::__construct('Invalid Range Maximum accepted value is ' . $max);
    }
}
