<?php

namespace Rakibhstu\Banglanumber;

class NumberToBangla
{
    /**
     * To keep compatibility to use new NumberToBangla()
     * Uses constructor property promotion (PHP 8.0+)
     */
    public function __construct(
        protected ?ProcessNumber $processNumber = null,
        protected ?ProcessDate $processDate = null,
    ) {
        $this->processNumber = $processNumber ?? app(ProcessNumber::class);
        $this->processDate = $processDate ?? app(ProcessDate::class);
    }

    /**
     * Convert number into Bangla representation
     * @param $number
     * @return string
     */
    public function bnNum($number): string
    {
        return $this->processNumber->bnNum($number);
    }

    /**
     * Convert number into Bangla Word
     * @param $number
     * @return string
     */
    public  function bnWord($number): string
    {
        return $this->processNumber->bnWord($number);
    }

    /**
     * Convert number into Bangla Money Format
     * @param $number
     * @return string
     */
    public function bnMoney($number): string
    {
        return $this->processNumber->bnMoney($number);
    }

    /**
     * Represent number in comma separator in Lakh, Crore format
     * @param $number
     * @return string
     */
    public function bnCommaLakh($number): string
    {
        return $this->processNumber->bnCommaLakh($number);
    }

    /**
     * Convert number into English Month Name
     * @param $number
     * @return string
     */
    public function bnMonth($number): string
    {
        return $this->processDate->bnMonth($number);
    }

    /**
     * Convert percentage to Bangla
     * 
     * @example bnPercentage(75.5) // Output: ৭৫.৫%
     * @example bnPercentage(75.5, true) // Output: পঁচাত্তর দশমিক পাঁচ শতাংশ
     */
    public function bnPercentage(int|float $number, bool $asWord = false): string
    {
        return $this->processNumber->bnPercentage($number, $asWord);
    }

    /**
     * Parse Bangla number back to English number
     * 
     * @example parseNum('১২৩৪৫') // Output: 12345
     * @example parseNum('১২,৩৪,৫৬৭') // Output: 1234567
     */
    public function parseNum(string $banglaNumber): int|float
    {
        return $this->processNumber->parseNum($banglaNumber);
    }

    /**
     * Get Bangla day name
     * 
     * @example bnDay(1) // Output: রবিবার
     * @example bnDay('monday') // Output: সোমবার
     */
    public function bnDay(int|string $day): string
    {
        return $this->processDate->bnDay($day);
    }

    /**
     * Format time in Bangla
     * 
     * @example bnTime('14:30') // Output: দুপুর ২:৩০
     * @example bnTime('14:30', true) // Output: দুপুর দুইটা ত্রিশ মিনিট
     */
    public function bnTime(string $time, bool $asWord = false): string
    {
        return $this->processDate->bnTime($time, $asWord);
    }

    /**
     * Format duration in Bangla
     * 
     * @example bnDuration(3665) // Output: ১ ঘন্টা ১ মিনিট ৫ সেকেন্ড
     */
    public function bnDuration(int $seconds): string
    {
        return $this->processDate->bnDuration($seconds);
    }

    /**
     * Get Bengali calendar month name
     * 
     * @example bnBengaliMonth(1) // Output: বৈশাখ
     * @example bnBengaliMonth(5) // Output: ভাদ্র
     */
    public function bnBengaliMonth(int $month): string
    {
        return $this->processDate->bnBengaliMonth($month);
    }

    /**
     * Get season name in Bangla
     * 
     * @example bnSeason(1) // Output: গ্রীষ্ম
     * @example bnSeason(5) // Output: শীত
     */
    public function bnSeason(int $season): string
    {
        return $this->processDate->bnSeason($season);
    }

    /**
     * Calculate and format age in Bangla
     * 
     * @example bnAge('1990-01-15') // Output: ৩৫ বছর
     * @example bnAge('1990-01-15', true) // Output: ৩৫ বছর ২ মাস ৫ দিন
     */
    public function bnAge(string $birthDate, bool $detailed = false): string
    {
        return $this->processDate->bnAge($birthDate, $detailed);
    }

    /**
     * Convert to array format (useful for API responses)
     * 
     * @return array{original: int|float, bangla_number: string, bangla_word: string, money_format: string|null}
     */
    public function toArray(int|float $number): array
    {
        return [
            'original' => $number,
            'bangla_number' => $this->bnNum($number),
            'bangla_word' => $this->bnWord($number),
            'money_format' => is_numeric($number) ? $this->bnMoney($number) : null,
            'comma_format' => $this->bnCommaLakh($number),
        ];
    }

    /**
     * Convert to JSON format
     */
    public function toJson(int|float $number, int $flags = JSON_UNESCAPED_UNICODE): string
    {
        return json_encode($this->toArray($number), $flags);
    }

    /**
     * Start a fluent conversion chain
     * 
     * @example number(12345)->toBangla()->asWord()->get()
     */
    public function number(int|float|string $number): FluentNumber
    {
        return new FluentNumber($number, $this);
    }

    /**
     * Convert multiple numbers at once
     * 
     * @param array<int|float> $numbers Array of numbers
     * @param string $method Method to apply (bnNum, bnWord, bnMoney)
     * @return array<string>
     */
    public function batch(array $numbers, string $method = 'bnNum'): array
    {
        return array_map(fn($num) => $this->$method($num), $numbers);
    }

    /**
     * Convert associative array with keys preserved
     * 
     * @param array<string, int|float> $data Associative array
     * @param string $method Method to apply
     * @return array<string, string>
     */
    public function batchWithKeys(array $data, string $method = 'bnNum'): array
    {
        return array_map(fn($value) => $this->$method($value), $data);
    }

    /**
     * Static helper for quick number conversion
     */
    public static function convert(int|float|string $number): string
    {
        return app(self::class)->bnNum($number);
    }

    /**
     * Static helper for quick word conversion
     */
    public static function words(int|float|string $number): string
    {
        return app(self::class)->bnWord($number);
    }

    /**
     * Static helper for quick money formatting
     */
    public static function money(int|float|string $number): string
    {
        return app(self::class)->bnMoney($number);
    }
}
