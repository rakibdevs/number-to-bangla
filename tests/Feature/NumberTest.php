<?php

namespace Rakibhstu\Banglanumber\Tests\Feature;

use Rakibhstu\Banglanumber\NumberToBangla;
use Rakibhstu\Banglanumber\Tests\TestCase;
class NumberTest extends TestCase
{
    protected $numto;

    protected function setUp(): void
    {
        parent::setUp();
        $this->numto = new NumberToBangla();
    }

    /** @test */
    public function it_converts_number_to_bangla()
    {
        $result = $this->numto->bnNum(123);
        $this->assertEquals('১২৩', $result);
    }

    /** @test */
    public function it_converts_number_to_bangla_word()
    {
        $result = $this->numto->bnWord(123);
        $this->assertIsString($result);
    }

    /** @test */
    public function it_converts_month_to_bangla()
    {
        $result = $this->numto->bnMonth(1);
        $this->assertIsString($result);
    }

    /** @test */
    public function it_converts_money_format_to_bangla()
    {
        $result = $this->numto->bnMoney(1000);
        $this->assertIsString($result);
    }
}
