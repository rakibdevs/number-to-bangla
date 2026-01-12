<?php

namespace Rakibhstu\Banglanumber\Tests\Feature;

use Rakibhstu\Banglanumber\Exceptions\InvalidRange;
use Rakibhstu\Banglanumber\NumberToBangla;
use Rakibhstu\Banglanumber\Tests\TestCase;

class ProcessDateTest extends TestCase
{
    protected NumberToBangla $numto;

    protected function setUp(): void
    {
        parent::setUp();
        $this->numto = new NumberToBangla();
    }

    /** @test */
    public function it_converts_month_number_to_bangla_name()
    {
        $result = $this->numto->bnMonth(1);
        $this->assertEquals('জানুয়ারি', $result);

        $result = $this->numto->bnMonth(12);
        $this->assertEquals('ডিসেম্বর', $result);
    }

    /** @test */
    public function it_throws_exception_for_month_above_12()
    {
        $this->expectException(InvalidRange::class);
        $this->expectExceptionMessage('Invalid Range Maximum accepted value is 12');

        $this->numto->bnMonth(13);
    }

    /** @test */
    public function it_converts_day_number_to_bangla_name()
    {
        $result = $this->numto->bnDay(1);
        $this->assertEquals('রবিবার', $result);

        $result = $this->numto->bnDay(7);
        $this->assertEquals('শনিবার', $result);
    }

    /** @test */
    public function it_converts_day_string_to_bangla_name()
    {
        $result = $this->numto->bnDay('monday');
        $this->assertEquals('সোমবার', $result);

        $result = $this->numto->bnDay('friday');
        $this->assertEquals('শুক্রবার', $result);
    }

    /** @test */
    public function it_converts_day_short_name_to_bangla()
    {
        $result = $this->numto->bnDay('sun');
        $this->assertEquals('রবিবার', $result);
    }

    /** @test */
    public function it_formats_time_in_bangla()
    {
        $result = $this->numto->bnTime('14:30');
        $this->assertStringContainsString('দুপুর', $result);
        $this->assertStringContainsString('২', $result);
        $this->assertStringContainsString('৩০', $result);
    }

    /** @test */
    public function it_formats_morning_time()
    {
        $result = $this->numto->bnTime('09:00');
        $this->assertStringContainsString('সকাল', $result);
    }

    /** @test */
    public function it_formats_evening_time()
    {
        $result = $this->numto->bnTime('18:30');
        $this->assertStringContainsString('সন্ধ্যা', $result);
    }

    /** @test */
    public function it_formats_night_time()
    {
        $result = $this->numto->bnTime('22:00');
        $this->assertStringContainsString('রাত', $result);
    }

    /** @test */
    public function it_formats_time_as_words()
    {
        $result = $this->numto->bnTime('14:30', asWord: true);
        $this->assertStringContainsString('দুপুর', $result);
        $this->assertStringContainsString('টা', $result);
        $this->assertStringContainsString('মিনিট', $result);
    }

    /** @test */
    public function it_formats_duration_in_seconds()
    {
        $result = $this->numto->bnDuration(45);
        $this->assertStringContainsString('সেকেন্ড', $result);
    }

    /** @test */
    public function it_formats_duration_in_minutes()
    {
        $result = $this->numto->bnDuration(90);
        $this->assertStringContainsString('মিনিট', $result);
        $this->assertStringContainsString('সেকেন্ড', $result);
    }

    /** @test */
    public function it_formats_duration_in_hours()
    {
        $result = $this->numto->bnDuration(3665);
        $this->assertStringContainsString('ঘন্টা', $result);
        $this->assertStringContainsString('মিনিট', $result);
        $this->assertStringContainsString('সেকেন্ড', $result);
    }

    /** @test */
    public function it_formats_duration_with_only_hours()
    {
        $result = $this->numto->bnDuration(3600);
        $this->assertStringContainsString('ঘন্টা', $result);
        $this->assertStringNotContainsString('মিনিট', $result);
    }

    /** @test */
    public function it_converts_bengali_month_number()
    {
        $result = $this->numto->bnBengaliMonth(1);
        $this->assertEquals('বৈশাখ', $result);

        $result = $this->numto->bnBengaliMonth(12);
        $this->assertEquals('চৈত্র', $result);
    }

    /** @test */
    public function it_converts_season_number()
    {
        $result = $this->numto->bnSeason(1);
        $this->assertEquals('গ্রীষ্ম', $result);

        $result = $this->numto->bnSeason(5);
        $this->assertEquals('শীত', $result);
    }

    /** @test */
    public function it_calculates_age_in_years()
    {
        $result = $this->numto->bnAge('1990-01-01');
        $this->assertStringContainsString('বছর', $result);
        $this->assertIsString($result);
    }

    /** @test */
    public function it_calculates_detailed_age()
    {
        $result = $this->numto->bnAge('2020-01-01', detailed: true);
        $this->assertIsString($result);
        // Should contain year, month, or day
    }
}
