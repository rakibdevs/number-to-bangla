<?php

namespace Tests\Feature;

use Rakibhstu\Banglanumber\Facades\NumberToBangla;
use Tests\TestCase;

class NumberTest extends TestCase
{
    /**
     * Can convert number to bangla word correctly
     *
     * @return void
     */
    public function test_can_convert_number_to_bangla_word_correclty()
    {
        $word = NumberToBangla::bnWord(13459);
    }
}
