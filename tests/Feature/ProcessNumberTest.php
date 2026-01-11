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
    public function it_converts_integer_to_bangla_number()
    {
        $result = $this->numto->bnNum(123);
        $this->assertEquals('১২৩', $result);
    }

    /** @test */
    public function it_converts_float_to_bangla_number()
    {
        $result = $this->numto->bnNum(123.45);
        $this->assertEquals('১২৩.৪৫', $result);
    }

    /** @test */
    public function it_converts_large_number_to_bangla()
    {
        $result = $this->numto->bnNum(1234567890);
        $this->assertEquals('১২৩৪৫৬৭৮৯০', $result);
    }

    /** @test */
    public function it_converts_zero_to_bangla()
    {
        $result = $this->numto->bnNum(0);
        $this->assertEquals('০', $result);
    }

    /** @test */
    public function it_converts_number_to_bangla_word()
    {
        $result = $this->numto->bnWord(123);
        $this->assertIsString($result);
        $this->assertStringContainsString('একশ', $result);
    }

    /** @test */
    public function it_converts_thousand_to_bangla_word()
    {
        $result = $this->numto->bnWord(1000);
        $this->assertIsString($result);
        $this->assertStringContainsString('হাজার', $result);
    }

    /** @test */
    public function it_converts_lakh_to_bangla_word()
    {
        $result = $this->numto->bnWord(100000);
        $this->assertIsString($result);
        $this->assertStringContainsString('লক্ষ', $result);
    }

    /** @test */
    public function it_converts_crore_to_bangla_word()
    {
        $result = $this->numto->bnWord(10000000);
        $this->assertIsString($result);
        $this->assertStringContainsString('করোড়', $result);
    }

    /** @test */
    public function it_converts_decimal_number_to_word()
    {
        $result = $this->numto->bnWord(12.5);
        $this->assertIsString($result);
        $this->assertStringContainsString('দশমিক', $result);
    }

    /** @test */
    public function it_formats_number_with_comma_in_lakh_format()
    {
        $result = $this->numto->bnCommaLakh(1234567);
        $this->assertEquals('১২,৩৪,৫৬৭', $result);
    }

    /** @test */
    public function it_formats_small_number_with_comma()
    {
        $result = $this->numto->bnCommaLakh(12345);
        $this->assertEquals('১২,৩৪৫', $result);
    }

    /** @test */
    public function it_converts_money_to_bangla_format()
    {
        $result = $this->numto->bnMoney(1000);
        $this->assertIsString($result);
        $this->assertStringContainsString('টাকা', $result);
    }

    /** @test */
    public function it_converts_money_with_paisa()
    {
        $result = $this->numto->bnMoney(1000.50);
        $this->assertIsString($result);
        $this->assertStringContainsString('টাকা', $result);
        $this->assertStringContainsString('পয়সা', $result);
    }

    /** @test */
    public function it_converts_money_without_paisa()
    {
        $result = $this->numto->bnMoney(5000);
        $this->assertStringContainsString('টাকা', $result);
        $this->assertStringNotContainsString('পয়সা', $result);
    }

    /** @test */
    public function it_converts_zero_money()
    {
        $result = $this->numto->bnMoney(0);
        $this->assertStringContainsString('শূন্য', $result);
        $this->assertStringContainsString('টাকা', $result);
    }
}
