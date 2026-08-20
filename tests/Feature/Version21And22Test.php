<?php

namespace Rakibhstu\Banglanumber\Tests\Feature;

use Rakibhstu\Banglanumber\Exceptions\InvalidNumber;
use Rakibhstu\Banglanumber\Exceptions\InvalidTime;
use Rakibhstu\Banglanumber\NumberToBangla;
use Rakibhstu\Banglanumber\Tests\TestCase;

class Version21And22Test extends TestCase
{
    private NumberToBangla $numto;

    protected function setUp(): void
    {
        parent::setUp();
        $this->numto = new NumberToBangla();
    }

    /** @test */
    public function it_preserves_decimal_digits_in_word_output(): void
    {
        $this->assertSame('শূন্য দশমিক শূন্য পাঁচ', $this->numto->bnWord('0.05'));
        $this->assertSame('১২.০৫০', $this->numto->bnNum('12.050'));
    }

    /** @test */
    public function it_supports_negative_numbers_and_money(): void
    {
        $this->assertSame('-১২৩', $this->numto->bnNum(-123));
        $this->assertSame('ঋণাত্মক এক শত তেইশ', $this->numto->bnWord(-123));
        $this->assertSame('ঋণাত্মক এক শত তেইশ টাকা', $this->numto->bnMoney(-123));
    }

    /** @test */
    public function it_rejects_malformed_numeric_input(): void
    {
        $this->expectException(InvalidNumber::class);
        $this->numto->bnNum('1e3');
    }

    /** @test */
    public function it_supports_documented_date_and_week_apis(): void
    {
        $this->assertSame('১৫ জানুয়ারি, ২০২৪', $this->numto->bnDate('2024-01-15'));
        $this->assertSame('৩', $this->numto->bnWeekNumber('2024-01-15'));
    }

    /** @test */
    public function it_supports_currency_and_ordinals(): void
    {
        $this->assertSame('এক হাজার পাঁচ শত টাকা পঁচিশ পয়সা', $this->numto->bnCurrency('1500.25'));
        $this->assertSame('প্রথম', $this->numto->bnOrdinal(1));
        $this->assertSame('বারোতম', $this->numto->bnOrdinal(12));
    }

    /** @test */
    public function it_rejects_invalid_times(): void
    {
        $this->expectException(InvalidTime::class);
        $this->numto->bnTime('25:61');
    }
}
