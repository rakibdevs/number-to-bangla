<?php

namespace Rakibhstu\Banglanumber;

use Rakibhstu\Banglanumber\ProcessNumber;

class NumberToBangla
{
    protected $process;

    public function __construct()
    {
        $this->process = new ProcessNumber;
    }

    public function bnNum($number)
    {
        return $this->process->bnNum($number);
    }


    public  function bnWord($number)
    {
        return $this->process->bnNum($number);
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
        return $this->process->bnMonth($number);
        
    }

}
