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
    public function isValid($number): void
    {
        if (is_bool($number) || $number === null || !is_scalar($number)) {
            throw new InvalidNumber();
        }

        $value = trim((string) $number);

        if (!preg_match('/^[+-]?\d+(?:\.\d+)?$/', $value)) {
            throw new InvalidNumber();
        }

        $integer = ltrim((string) preg_replace('/^[+-]/', '', explode('.', $value, 2)[0]), '0');
        $integer = $integer === '' ? '0' : $integer;

        if (strlen($integer) > 15 || (strlen($integer) === 15 && strcmp($integer, '999999999999999') > 0)) {
            throw new InvalidRange();
        }
    }
}
