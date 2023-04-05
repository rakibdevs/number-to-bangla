<?php

namespace Rakibhstu\Banglanumber;

class NumberToBangla
{
    // To keep compatibility to use new NumberToBangla()
    public function __construct(
        protected ProcessNumber|null $processNumber = null,
        protected ProcessDate|null $processDate = null
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
}
