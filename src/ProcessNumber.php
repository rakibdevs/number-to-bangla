<?php

namespace Rakibhstu\Banglanumber;

use Rakibhstu\Banglanumber\Exceptions\InvalidNumber;
use Rakibhstu\Banglanumber\Exceptions\InvalidRange;

class ProcessNumber
{
    /**
     * @var string[]
     */
    protected $words = [
        '',
        'এক',
        'দুই',
        'তিন',
        'চার',
        'পাঁচ',
        'ছয়',
        'সাত',
        'আট',
        'নয়',
        'দশ',
        'এগারো',
        'বারো',
        'তেরো',
        'চৌদ্দ',
        'পনেরো',
        'ষোল',
        'সতেরো',
        'আঠারো',
        'উনিশ',
        'বিশ',
        'একুশ',
        'বাইশ',
        'তেইশ',
        'চব্বিশ',
        'পঁচিশ',
        'ছাব্বিশ',
        'সাতাশ',
        'আঠাশ',
        'ঊনত্রিশ',
        'ত্রিশ',
        'একত্রিশ',
        'বত্রিশ',
        'তেত্রিশ',
        'চৌত্রিশ',
        'পঁয়ত্রিশ',
        'ছত্রিশ',
        'সাঁইত্রিশ',
        'আটত্রিশ',
        'ঊনচল্লিশ',
        'চল্লিশ',
        'একচল্লিশ',
        'বিয়াল্লিশ',
        'তেতাল্লিশ',
        'চুয়াল্লিশ',
        'পঁয়তাল্লিশ',
        'ছেচল্লিশ',
        'সাতচল্লিশ',
        'আটচল্লিশ',
        'ঊনপঞ্চাশ',
        'পঞ্চাশ',
        'একান্ন',
        'বাহান্ন',
        'তিপ্পান্ন',
        'চুয়ান্ন',
        'পঞ্চান্ন',
        'ছাপ্পান্ন',
        'সাতান্ন',
        'আটান্ন',
        'ঊনষাট',
        'ষাট',
        'একষট্টি',
        'বাষট্টি',
        'তেষট্টি',
        'চৌষট্টি',
        'পঁয়ষট্টি',
        'ছেষট্টি',
        'সাতষট্টি',
        'আটষট্টি',
        'ঊনসত্তর',
        'সত্তর',
        'একাত্তর',
        'বাহাত্তর',
        'তিয়াত্তর',
        'চুয়াত্তর',
        'পঁচাত্তর',
        'ছিয়াত্তর',
        'সাতাত্তর',
        'আটাত্তর',
        'ঊনআশি',
        'আশি',
        'একাশি',
        'বিরাশি',
        'তিরাশি',
        'চুরাশি',
        'পঁচাশি',
        'ছিয়াশি',
        'সাতাশি',
        'আটাশি',
        'ঊননব্বই',
        'নব্বই',
        'একানব্বই',
        'বিরানব্বই',
        'তিরানব্বই',
        'চুরানব্বই',
        'পঁচানব্বই',
        'ছিয়ানব্বই',
        'সাতানব্বই',
        'আটানব্বই',
        'নিরানব্বই'
    ];

    /**
     * @var string[]
     */
    protected $bn_num = [
        'শূন্য',
        'এক',
        'দুই',
        'তিন',
        'চার',
        'পাঁচ',
        'ছয়',
        'সাত',
        'আট',
        'নয়'
    ];

    /**
     * @var string[]
     */
    protected $numbers = [
        '০',
        '১',
        '২',
        '৩',
        '৪',
        '৫',
        '৬',
        '৭',
        '৮',
        '৯'
    ];


    /**
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function isValid($number)
    {
        if (!is_numeric($number)) {
            throw InvalidNumber::message();
        }

        if ($number > 999999999999999 || strpos($number, 'E') !== false) {
            throw InvalidRange::message();
        }
    }

    /**
     * @param $number
     * @return string
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function bnNum($number)
    {
        $this->isValid($number);

        return strtr($number, $this->numbers);
    }


    /**
     * @param $number
     * @return string
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function bnWord($number)
    {
        $this->isValid($number);

        if ($number == 0) {
            return 'শূন্য';
        }

        if (is_float($number)) {
            return $this->convertFloatNumberToWord($number);
        }

        return $this->toWord($number);
    }

    /**
     * @param $number
     * @return string
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function bnMoney($number)
    {
        $this->isValid($number);

        if ($number == 0) {
            return 'শূন্য টাকা';
        }

        if (is_float($number)) {
            return $this->convertFloatNumberToMoneyFormat($number);
        }

        return $this->toWord($number) . ' টাকা ';
    }

    /**
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function bnCommaLakh($number)
    {
        $this->isValid($number);

        $n = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $number);

        return strtr($n, $this->numbers);
    }

    /**
     * @param $num
     * @return string
     */
    protected function toWord($num)
    {
        $text = '';
        $crore = (int) ($num / 10000000);
        if ($crore != 0) {
            if ($crore > 99) {
                $text .= $this->bnWord($crore) . ' কোটি ';
            } else {
                $text .= $this->words[$crore] . ' কোটি ';
            }
        }

        $crore_div = $num % 10000000;

        $lakh = (int) ($crore_div / 100000);
        if ($lakh > 0) {
            $text .= $this->words[$lakh] . ' লক্ষ ';
        }

        $lakh_div = $crore_div % 100000;

        $thousand = (int) ($lakh_div / 1000);
        if ($thousand > 0) {
            $text .= $this->words[$thousand] . ' হাজার ';
        }

        $thousand_div = $lakh_div % 1000;

        $hundred = (int) ($thousand_div / 100);
        if ($hundred > 0) {
            $text .= $this->words[$hundred] . ' শত ';
        }

        $hundred_div = $thousand_div % 100;
        if ($hundred_div > 0) {
            $text .= $this->words[$hundred_div];
        }

        return $text;
    }

    /**
     * @param $num
     * @return string
     */
    protected function toDecimalWord($num)
    {
        $text = '';
        $decimalParts = str_split($num);
        foreach ($decimalParts as $decimalPart) {
            $text .= $this->bn_num[$decimalPart] . ' ';
        }

        return $text;
    }

    /**
     * Convert float number to text
     *
     */
    private function convertFloatNumberToWord($number)
    {
        $decimalPart = explode(".", $number);
        $text = $this->toWord($decimalPart[0]);
        if (isset($decimalPart[1])) {
            $text .= ' দশমিক ' . $this->toDecimalWord((string)$decimalPart[1]);
        }

        return $text;
    }

    /**
     * Convert float number to money format
     * @param $number
     * @return string
     */
    private function convertFloatNumberToMoneyFormat($number)
    {
        $money  = number_format((float)$number, 2, '.', '');
        $decimalPart = explode(".", $money);
        $text = $this->toWord($decimalPart[0]) . ' টাকা ';
        if (isset($decimalPart[1])) {
            $text .= $this->words[(int)$decimalPart[1]] . ' পয়সা';
        }

        return $text;
    }
}
