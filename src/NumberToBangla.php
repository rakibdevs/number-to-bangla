<?php

namespace Rakibhstu\Banglanumber;

class NumberToBangla
{
    /**
     * @var ProcessNumber
     */
    private $process;

    /**
     * @var ProcessDate
     */
    private $date;

    /**
     * Number to Bangla Constructor
     */
    public function __construct()
    {
        $this->process = new ProcessNumber();
        $this->date    = new ProcessDate();
    }

    /**
     * @param $number
     * @return string
     */
    public function bnNum($number)
    {
        return $this->process->bnNum($number);
    }

    /**
     * @param $number
     * @return string
     */
    public  function bnWord($number)
    {
        return $this->process->bnWord($number);
    }

    /**
     * @param $number
     * @return string
     */
    public  function bnMoney($number)
    {
        return $this->process->bnMoney($number);
    }

    /**
     * @param $number
     * @return string
     */
    public function bnCommaLakh($number)
    {
        return $this->process->bnCommaLakh($number);
    }

    /**
     * @param $number
     * @return string
     * @throws Exceptions\InvalidNumber
     * @throws Exceptions\InvalidRange
     */
    public function bnMonth($number)
    {
        return $this->date->bnMonth($number);
    }
}
