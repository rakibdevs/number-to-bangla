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

    protected array $bnToEn = [
        '০' => '0', '১' => '1', '২' => '2', '৩' => '3', '৪' => '4',
        '৫' => '5', '৬' => '6', '৭' => '7', '৮' => '8', '৯' => '9'
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

        return strtr($this->normalize($number), $this->numbers);
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

        $number = $this->normalize($number);
        $negative = str_starts_with($number, '-');
        $number = ltrim($number, '+-');

        if ($number === '0') {
            return 'শূন্য';
        }

        if (str_contains($number, '.')) {
            $parts = explode('.', $number, 2);
            $integerText = $parts[0] === '0' ? 'শূন্য' : $this->toWord((int) $parts[0]);
            $text = $integerText . ' দশমিক' . $this->toDecimalWord($parts[1]);
            return ($negative ? 'ঋণাত্মক ' : '') . $text;
        }

        return ($negative ? 'ঋণাত্মক ' : '') . $this->toWord((int) $number);
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

        $value = $this->normalize($number);
        $negative = str_starts_with($value, '-');
        $value = ltrim($value, '+-');
        [$integer, $decimal] = array_pad(explode('.', $value, 2), 2, '');
        $decimal = str_pad($decimal, 2, '0');
        $cents = (int) substr($decimal, 0, 2);
        if (isset($decimal[2]) && (int) $decimal[2] >= 5) {
            $cents++;
        }
        $total = ((int) $integer * 100) + $cents;
        $integer = intdiv($total, 100);
        $cents = $total % 100;

        if ($total === 0) {
            return 'শূন্য টাকা';
        }

        $text = ($integer === 0 ? 'শূন্য' : $this->toWord($integer)) . ' টাকা';
        if ($cents > 0) {
            $text .= ' ' . $this->toWord($cents) . ' পয়সা';
        }

        return ($negative && $total > 0 ? 'ঋণাত্মক ' : '') . $text;
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

        $value = $this->normalize($number);
        $sign = str_starts_with($value, '-') ? '-' : '';
        $value = ltrim($value, '+-');
        [$integer, $decimal] = array_pad(explode('.', $value, 2), 2, null);
        $last = substr($integer, -3);
        $prefix = substr($integer, 0, -3);
        $groups = [];
        while ($prefix !== '') {
            $groups[] = substr($prefix, -2);
            $prefix = substr($prefix, 0, -2);
        }
        $n = implode(',', array_reverse($groups));
        $n = ($n === '' ? '' : $n . ',') . $last;
        if ($decimal !== null) {
            $n .= '.' . $decimal;
        }

        return strtr($sign . $n, $this->numbers);
    }

    /**
     * @param $num
     * @return string
     */
    protected function toWord($num): string
    {
        $scales = [
            10000000000000 => 'নীল',
            100000000000 => 'খরব',
            1000000000 => 'আরব',
            10000000 => 'কোটি',
            100000 => 'লক্ষ',
            1000 => 'হাজার',
        ];
        $text = '';

        foreach ($scales as $scale => $label) {
            if ($num >= $scale) {
                $count = intdiv($num, $scale);
                $text .= ($count < 100 ? $this->words[$count] : $this->toWord($count)) . ' ' . $label . ' ';
                $num %= $scale;
            }
        }

        if ($num >= 100) {
            $text .= $this->words[intdiv($num, 100)] . ' শত ';
            $num %= 100;
        }
        if ($num > 0) {
            $text .= $this->words[$num];
        }

        return trim($text);
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

    /**
     * Convert percentage to Bangla
     */
    public function bnPercentage(int|float|string $number, bool $asWord = false): string
    {
        if ($asWord) {
            return $this->bnWord($number) . ' শতাংশ';
        }
        return $this->bnNum($number) . '%';
    }

    /** Convert an amount using the package's default BDT units. */
    public function bnCurrency(int|float|string $number, string $unit = 'টাকা', string $subunit = 'পয়সা'): string
    {
        return str_replace(['টাকা', 'পয়সা'], [$unit, $subunit], $this->bnMoney($number));
    }

    /** Convert a number to a commonly used Bangla ordinal. */
    public function bnOrdinal(int $number): string
    {
        $ordinals = [1 => 'প্রথম', 2 => 'দ্বিতীয়', 3 => 'তৃতীয়', 4 => 'চতুর্থ', 5 => 'পঞ্চম', 6 => 'ষষ্ঠ', 7 => 'সপ্তম', 8 => 'অষ্টম', 9 => 'নবম', 10 => 'দশম'];
        return $ordinals[$number] ?? $this->bnWord($number) . 'তম';
    }

    protected function normalize($number): string
    {
        $value = trim((string) $number);
        if (is_float($number)) {
            $value = rtrim(rtrim(sprintf('%.14F', $number), '0'), '.');
        }
        return $value === '-0' ? '0' : $value;
    }

    /**
     * Parse Bangla number to English number
     */
    public function parseNum(string $banglaNumber): int|float
    {
        // Remove commas and spaces
        $banglaNumber = str_replace([',', ' ', '৳'], '', $banglaNumber);
        
        // Convert Bangla digits to English
        $englishNumber = strtr($banglaNumber, $this->bnToEn);
        
        // Check if it's a float
        if (str_contains($englishNumber, '.')) {
            return (float) $englishNumber;
        }
        
        return (int) $englishNumber;
    }
}
