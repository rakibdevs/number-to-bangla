<?php

namespace Rakibhstu\Banglanumber;

use Carbon\Carbon;
use Rakibhstu\Banglanumber\Exceptions\InvalidNumber;
use Rakibhstu\Banglanumber\Exceptions\InvalidRange;

class ProcessDate
{
    use NumberValidator;

    protected ProcessNumber $numberProcessor;
    protected string $locale = 'bn_BD';

    public function __construct(ProcessNumber $numberProcessor)
    {
        $this->numberProcessor = $numberProcessor;
    }

    /**
     * @var array
     */
    private array $month = [
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
     * Convert number into English Month Name
     * 
     * @param mixed $number
     * @return ?string
     * @throws InvalidNumber
     * @throws InvalidRange
     */
    public function bnMonth(mixed $number): ?string
    {
        $this->isValid($number);

        if ($number >= 1 && $number <= 12) {
            return $this->month[(int)$number];
        }

        throw new InvalidRange(12);
    }

    /**
     * Get Bangla day name
     */
    public function bnDay(int|string $day): string
    {
        $days = [
            1 => 'রবিবার', 'sunday' => 'রবিবার', 'sun' => 'রবিবার',
            2 => 'সোমবার', 'monday' => 'সোমবার', 'mon' => 'সোমবার',
            3 => 'মঙ্গলবার', 'tuesday' => 'মঙ্গলবার', 'tue' => 'মঙ্গলবার',
            4 => 'বুধবার', 'wednesday' => 'বুধবার', 'wed' => 'বুধবার',
            5 => 'বৃহস্পতিবার', 'thursday' => 'বৃহস্পতিবার', 'thu' => 'বৃহস্পতিবার',
            6 => 'শুক্রবার', 'friday' => 'শুক্রবার', 'fri' => 'শুক্রবার',
            7 => 'শনিবার', 'saturday' => 'শনিবার', 'sat' => 'শনিবার'
        ];

        $key = is_numeric($day) ? (int)$day : strtolower($day);
        return $days[$key] ?? '';
    }

    /**
     * Format time in Bangla
     */
    public function bnTime(string $time, bool $asWord = false): string
    {
        $timeParts = explode(':', $time);
        $hours = (int)$timeParts[0];
        $minutes = isset($timeParts[1]) ? (int)$timeParts[1] : 0;

        $period = $this->getTimePeriod($hours);
        $displayHours = $hours > 12 ? $hours - 12 : ($hours === 0 ? 12 : $hours);

        if ($asWord) {
            $hoursText = $this->numberProcessor->bnWord($displayHours);
            $minutesText = $minutes > 0 ? ' ' . $this->numberProcessor->bnWord($minutes) . ' মিনিট' : '';
            return $period . ' ' . $hoursText . 'টা' . $minutesText;
        }

        $hoursNum = $this->numberProcessor->bnNum($displayHours);
        $minutesNum = $this->numberProcessor->bnNum(str_pad($minutes, 2, '0', STR_PAD_LEFT));

        return $period . ' ' . $hoursNum . ':' . $minutesNum;
    }

    /**
     * Get time period based on hour
     */
    protected function getTimePeriod(int $hour): string
    {
        $periods = [
            'night' => 'রাত',
            'morning' => 'সকাল',
            'noon' => 'দুপুর',
            'afternoon' => 'বিকাল',
            'evening' => 'সন্ধ্যা',
        ];

        if ($hour < 6) {
            return $periods['night'];
        } elseif ($hour < 12) {
            return $periods['morning'];
        } elseif ($hour < 15) {
            return $periods['noon'];
        } elseif ($hour < 18) {
            return $periods['afternoon'];
        } elseif ($hour < 20) {
            return $periods['evening'];
        }

        return $periods['night'];
    }

    /**
     * Format duration in Bangla
     */
    public function bnDuration(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        $parts = [];

        if ($hours > 0) {
            $parts[] = $this->numberProcessor->bnNum($hours) . ' ঘন্টা';
        }

        if ($minutes > 0) {
            $parts[] = $this->numberProcessor->bnNum($minutes) . ' মিনিট';
        }

        if ($secs > 0 || empty($parts)) {
            $parts[] = $this->numberProcessor->bnNum($secs) . ' সেকেন্ড';
        }

        return implode(' ', $parts);
    }

    /**
     * Calculate and format age in Bangla
     */
    public function bnAge(string $birthDate, bool $detailed = false): string
    {
        try {
            $birth = Carbon::parse($birthDate);
            $now = Carbon::now();
            
            $years = $birth->diffInYears($now);
            
            if (!$detailed) {
                return $this->numberProcessor->bnNum($years) . ' বছর';
            }
            
            $months = $birth->copy()->addYears($years)->diffInMonths($now);
            $days = $birth->copy()->addYears($years)->addMonths($months)->diffInDays($now);
            
            $parts = [];
            
            if ($years > 0) {
                $parts[] = $this->numberProcessor->bnNum($years) . ' বছর';
            }
            
            if ($months > 0) {
                $parts[] = $this->numberProcessor->bnNum($months) . ' মাস';
            }
            
            if ($days > 0) {
                $parts[] = $this->numberProcessor->bnNum($days) . ' দিন';
            }
            
            return implode(' ', $parts);
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Get week number in Bangla
     */
    public function bnWeekNumber(string $date): string
    {
        try {
            $carbon = Carbon::parse($date);
            return $this->numberProcessor->bnNum($carbon->weekOfYear);
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Get Bengali calendar month name
     */
    public function bnBengaliMonth(int $month): string
    {
        $months = [
            1 => 'বৈশাখ', 2 => 'জ্যৈষ্ঠ', 3 => 'আষাঢ়', 4 => 'শ্রাবণ',
            5 => 'ভাদ্র', 6 => 'আশ্বিন', 7 => 'কার্তিক', 8 => 'অগ্রহায়ণ',
            9 => 'পৌষ', 10 => 'মাঘ', 11 => 'ফাল্গুন', 12 => 'চৈত্র'
        ];

        return $months[$month] ?? '';
    }

    /**
     * Get season name in Bangla
     */
    public function bnSeason(int $season): string
    {
        $seasons = [
            1 => 'গ্রীষ্ম',    // Summer (April-May)
            2 => 'বর্ষা',      // Monsoon (June-July)
            3 => 'শরৎ',       // Autumn (August-September)
            4 => 'হেমন্ত',     // Late Autumn (October-November)
            5 => 'শীত',       // Winter (December-January)
            6 => 'বসন্ত'      // Spring (February-March)
        ];

        return $seasons[$season] ?? '';
    }
}
