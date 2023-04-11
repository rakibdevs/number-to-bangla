<?php
namespace Rakibhstu\Banglanumber;

use Rakibhstu\Banglanumber\Exceptions\InvalidNumber;
use Rakibhstu\Banglanumber\Exceptions\InvalidRange;

trait NumberValidator
{
    /**
     * Validate if the given number is a valid number for conversion.
     *
     * @param mixed $number The number to validate.
     *
     * @throws InvalidNumber If the number is not valid.
     * @throws InvalidRange If the number is out of valid range.
     *
     * @return void
     */
    public function isValid($number)
    {
        if (!is_numeric($number) || preg_match('/\.\d+\./', $number) || preg_match('/\d+E\d+/', $number)) {
            throw new InvalidNumber();
        }

        if (abs($number) > 999999999999999) {
            throw new InvalidRange();
        }
    }
}