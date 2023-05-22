<?php

namespace Rakibhstu\Banglanumber;

use Rakibhstu\Banglanumber\Exceptions\InvalidNumber;
use Rakibhstu\Banglanumber\Exceptions\InvalidRange;

class ProcessNumber
{
    use NumberValidator;

    /**
     * @var array[]
     */
    protected $words = [
        'শূন্য',
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
     * @var array[]
     */
    private array $numbers = [
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
     * Convert number into Bangla representation
     * 
     * @param $number
     * @return string
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function bnNum($number): string
    {
        $this->isValid($number);

        return strtr($number, $this->numbers);
    }


    /**
     * Convert number into Bangla Word
     * 
     * @param $number
     * @return string
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function bnWord($number): string
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
     * Convert number into Bangla Money Format
     * 
     * @param $number
     * @return string
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function bnMoney($number): string
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
     * Represent number in comma separator in Lakh, Crore format
     * 
     * @param $number
     * @return string
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function bnCommaLakh($number): string
    {
        $this->isValid($number);

        $n = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $number);

        return strtr($n, $this->numbers);
    }

    /**
     * @param $num
     * @return string
     */
    protected function toWord($num): string
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

        $croreDiv = $num % 10000000;

        $lakh = (int) ($croreDiv / 100000);
        if ($lakh > 0) {
            $text .= $this->words[$lakh] . ' লক্ষ ';
        }

        $lakhDiv = $croreDiv % 100000;

        $thousand = (int) ($lakhDiv / 1000);
        if ($thousand > 0) {
            $text .= $this->words[$thousand] . ' হাজার ';
        }

        $thousandDiv = $lakhDiv % 1000;

        $hundred = (int) ($thousandDiv / 100);
        if ($hundred > 0) {
            $text .= $this->words[$hundred] . ' শত ';
        }

        $hundredDiv = $thousandDiv % 100;
        if ($hundredDiv > 0) {
            $text .= $this->words[$hundredDiv];
        }

        return $text;
    }

    /**
     * @param $num
     * @return string
     */
    protected function toDecimalWord($number): string
    {
        $word = '';
        $numberLength = strlen($number);

        // Loop through each digit of the number
        for ($i = 0; $i < $numberLength; $i++) {
            $digit = (int)$number[$i];
            $word .= ' ' . $this->words[$digit];
        }

        return $word;
    }

    /**
     * Convert float number to text
     * @param $number
     * @return string
     */
    private function convertFloatNumberToWord($number): string
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
    private function convertFloatNumberToMoneyFormat($number): string
    {
        $money  = number_format((float)$number, 2, '.', '');
        $decimalPart = explode(".", $money);
        $text = $this->toWord($decimalPart[0]) . ' টাকা ';
        if (isset($decimalPart[1])&& (int)$decimalPart[1]>0) {
            $text .= $this->words[(int)$decimalPart[1]] . ' পয়সা';
        }

        return $text;
    }
}
