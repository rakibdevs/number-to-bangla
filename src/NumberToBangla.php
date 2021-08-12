<?php

namespace Rakibhstu\Banglanumber;

use Rakibhstu\Banglanumber\ProcessNumber;
use Rakibhstu\Banglanumber\ProcessDate;

class NumberToBangla
{
    protected $process;

    protected $date;

    public function __construct()
    {
        $this->process = new ProcessNumber;
        $this->date    = new ProcessDate;
    }

    public function bnNum($number)
    {
        return $this->process->bnNum($number);
    }


    public  function bnWord($number)
    { 
        return $this->process->bnWord($number);
    }

    public  function bnMoney($number)
    {    
        return $this->process->bnMoney($number);
    }

    public function bnCommaLakh($number)
    {
         return $this->process->bnCommaLakh($number);
    }

    public  function bnMonth($number)
    {
        return $this->date->bnMonth($number);
        
    }

}
