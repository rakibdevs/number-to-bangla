<?php

namespace Rakibhstu\Banglanumber;

class NumberToBangla
{

    protected  $words = array(
                            '', 'এক', 'দুই', 'তিন', 'চার', 'পাঁচ', 'ছয়', 'সাত', 'আট', 'নয়', 'দশ', 'এগারো', 'বারো', 'তেরো', 'চৌদ্দ', 'পনেরো', 'ষোল', 'সতেরো', 'আঠারো', 'উনিশ','বিশ','একুশ', 'বাইশ', 'তেইশ', 'চব্বিশ', 'পঁচিশ', 'ছাব্বিশ', 'সাতাশ', 'আঠাশ', 'ঊনত্রিশ', 'ত্রিশ', 'একত্রিশ', 'বত্রিশ', 'তেত্রিশ', 'চৌত্রিশ', 'পঁয়ত্রিশ', 'ছত্রিশ', 'সাঁইত্রিশ', 'আটত্রিশ', 'ঊনচল্লিশ','চল্লিশ','একচল্লিশ', 'বিয়াল্লিশ', 'তেতাল্লিশ', 'চুয়াল্লিশ', 'পঁয়তাল্লিশ', 'ছেচল্লিশ', 'সাতচল্লিশ', 'আটচল্লিশ', 'ঊনপঞ্চাশ', 'পঞ্চাশ', 'একান্ন','বাহান্ন', 'তিপ্পান্ন', 'চুয়ান্ন', 'পঞ্চান্ন', 'ছাপ্পান্ন', 'সাতান্ন', 'আটান্ন', 'ঊনষাট','ষাট','একষট্টি', 'বাষট্টি', 'তেষট্টি', 'চৌষট্টি', 'পঁয়ষট্টি', 'ছেষট্টি', 'সাতষট্টি', 'আটষট্টি', 'ঊনসত্তর', 'সত্তর', 'একাত্তর','বাহাত্তর', 'তিয়াত্তর', 'চুয়াত্তর', 'পঁচাত্তর', 'ছিয়াত্তর', 'সাতাত্তর', 'আটাত্তর', 'ঊনআশি','আশি','একাশি', 'বিরাশি', 'তিরাশি', 'চুরাশি','পঁচাশি', 'ছিয়াশি', 'সাতাশি', 'আটাশি', 'ঊননব্বই', 'নব্বই', 'একানব্বই','বিরানব্বই', 'তিরানব্বই', 'চুরানব্বই', 'পঁচানব্বই', 'ছিয়ানব্বই', 'সাতানব্বই', 'আটানব্বই', 'নিরানব্বই'
                        );

    protected  $bn_num = array('শূন্য', 'এক', 'দুই', 'তিন', 'চার', 'পাঁচ', 'ছয়', 'সাত', 'আট', 'নয়');

    protected  $bn_month = array(
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
                                );

    protected  $numbers = array('০','১','২','৩','৪','৫','৬','৭','৮','৯');


    public function bnNum($num)
    {
        $valid = $this->numIsValid($num);

        if($valid == false){
            return false;
        }

        return strtr($num,$this->numbers);
    }


    public  function bnWord($num)
    {

        $valid = $this->numIsValid($num);

        if($valid == false){
            return false;
        }
        
        if($num == 0){
            return 'শূন্য';
        }

        if(is_float($num)){
            $decimal = explode(".", $num);
            $text = $this->numToWord($decimal[0]);
            if(isset($decimal[1])){
                $text .= ' দশমিক '.$this->numToDecimalWord((string)$decimal[1]);
            }
            return $text;
        }else{
            return $this->numToWord($num);
        }
    

    }

    public  function bnMoney($num)
    {

        $valid = $this->numIsValid($num);

        if($valid == false){
            return false;
        }
        
        if($num == 0){
            return 'শূন্য টাকা';
        }

        if(is_float($num)){
            $money  = number_format((float)$num, 2, '.', '');
            $decimal = explode(".", $money);
            $text = $this->numToWord($decimal[0]).' টাকা ';
            if(isset($decimal[1])){
                $text .= $this->words[(int)$decimal[1]].' পয়সা';
            }
            return $text;
        }else{
            return $this->numToWord($num).' টাকা ';
        }
    

    }


    public  function bnMonth($num)
    {
        if(!is_numeric($num)){
            return false;
        }

        if($num >= 1 && $num <=12 ){
            return $this->bn_month[(int)$num];
        }
        return false;
        
    }

    public function bnCommaLakh($num)
    {
        $valid = $this->numIsValid($num);

        if($valid == false){
            return false;
        }

        $n = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $num);
        return strtr($n,$this->numbers);
         
    }
    
    protected  function numIsValid($num)
    {
        if(!is_numeric($num)){
            return false;
        }

        if($num>999999999999999){
            return false;
        }

        if(strpos($num, 'E') !== false){
            return false;
        }

        return true;
        
    }

    protected  function numToWord($num)
    {

        $text = '';

        $crore = (int) ($num/10000000);
        if($crore != 0){
            if($crore > 99){
                $text .= $this->bnWord($crore).' কোটি '; 
            }else{
                $text .= $this->words[$crore].' কোটি ';
            }
        }
        

        $crore_div = $num%10000000;

        $lakh = (int) ($crore_div/100000);
        if($lakh > 0){
            $text .= $this->words[$lakh].' লক্ষ ';
        }

        $lakh_div = $crore_div%100000;

        $thousand = (int) ($lakh_div/1000);
        if($thousand > 0){
            $text .= $this->words[$thousand].' হাজার ';
        }

        $thousand_div = $lakh_div%1000;

        $hundred = (int) ($thousand_div/100);
        if($hundred > 0){
            $text .= $this->words[$hundred].' শত ';
        }

        $hundred_div = (int) ($thousand_div%100);
        if($hundred_div > 0){
            $text .= $this->words[$hundred_div];
        }


        return $text;

    }

    protected  function numToDecimalWord($num)
    {
        $decimals = str_split($num);
        $text = '';
        foreach ($decimals as $key => $decimal) {
            $text .= $this->bn_num[$decimal].' ';   
        }
        return $text;
    }

}
