<?php

namespace Rakibhstu\Banglanumber;

use Rakibhstu\Banglanumber\Exceptions\InvalidNumber;
use Rakibhstu\Banglanumber\Exceptions\InvalidRange;

class ProcessDate
{
    /**
     * @var string[]
     */
    private $bn_month = [
        '1' => 'জানুয়ারি',
        '2' => 'ফেব্রুয়ারি',
        '3' => 'মার্চ',
        '4' => 'এপ্রিল',
        '5' => 'মে',
        '6' => 'জুন',
        '7' => 'জুলাই',
        '8' => 'আগস্ট',
        '9' => 'সেপ্টেম্বর',
        '10' => 'অক্টোবর',
        '11' => 'নভেম্বর',
        '12' => 'ডিসেম্বর'
    ];


    /**
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    private function isValid($number)
    {
        if (!is_numeric($number)) {
            throw InvalidNumber::message();
        }

        if ($number > 999999999999999 || strpos($number, 'E') !== false) {
            throw InvalidRange::message();
        }
    }


    /**
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function bnMonth($number)
    {
        $this->isValid($number);

        if ($number >= 1 && $number <= 12) {
            return $this->bn_month[(int)$number];
        }

        throw InvalidRange::message(12);
    }
}
