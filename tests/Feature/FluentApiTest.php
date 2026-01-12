<?php

namespace Rakibhstu\Banglanumber\Tests\Feature;

use Rakibhstu\Banglanumber\NumberToBangla;
use Rakibhstu\Banglanumber\FluentNumber;
use Rakibhstu\Banglanumber\Tests\TestCase;

class FluentApiTest extends TestCase
{
    protected NumberToBangla $numto;

    protected function setUp(): void
    {
        parent::setUp();
        $this->numto = new NumberToBangla();
    }

    /** @test */
    public function it_creates_fluent_number_instance()
    {
        $fluent = $this->numto->number(12345);

        $this->assertInstanceOf(FluentNumber::class, $fluent);
    }

    /** @test */
    public function it_converts_to_bangla_number_fluently()
    {
        $result = $this->numto->number(12345)
            ->toBangla()
            ->get();

        $this->assertEquals('১২৩৪৫', $result);
    }

    /** @test */
    public function it_converts_to_bangla_word_fluently()
    {
        $result = $this->numto->number(123)
            ->asWord()
            ->get();

        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }

    /** @test */
    public function it_converts_to_money_fluently()
    {
        $result = $this->numto->number(1000)
            ->asMoney()
            ->get();

        $this->assertStringContainsString('টাকা', $result);
    }

    /** @test */
    public function it_adds_prefix_fluently()
    {
        $result = $this->numto->number(12345)
            ->toBangla()
            ->withPrefix('মোট: ')
            ->get();

        $this->assertStringStartsWith('মোট: ', $result);
    }

    /** @test */
    public function it_adds_suffix_fluently()
    {
        $result = $this->numto->number(12345)
            ->toBangla()
            ->withSuffix(' টাকা')
            ->get();

        $this->assertStringEndsWith(' টাকা', $result);
    }

    /** @test */
    public function it_adds_prefix_and_suffix_fluently()
    {
        $result = $this->numto->number(12345)
            ->asWord()
            ->withPrefix('মোট: ')
            ->withSuffix(' টাকা')
            ->get();

        $this->assertStringStartsWith('মোট: ', $result);
        $this->assertStringEndsWith(' টাকা', $result);
    }

    /** @test */
    public function it_converts_to_percentage_fluently()
    {
        $result = $this->numto->number(75)
            ->asPercentage()
            ->get();

        $this->assertEquals('৭৫%', $result);
    }

    /** @test */
    public function it_converts_to_percentage_word_fluently()
    {
        $result = $this->numto->number(75)
            ->asPercentage(asWord: true)
            ->get();

        $this->assertStringContainsString('শতাংশ', $result);
    }

    /** @test */
    public function it_chains_multiple_operations()
    {
        $result = $this->numto->number(12345)
            ->toBangla()
            ->asWord()
            ->withPrefix('আপনার বেতন: ')
            ->withSuffix(' টাকা মাত্র')
            ->get();

        $this->assertStringContainsString('আপনার বেতন: ', $result);
        $this->assertStringContainsString('টাকা মাত্র', $result);
    }

    /** @test */
    public function it_converts_to_array_fluently()
    {
        $result = $this->numto->number(12345)->toArray();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('original', $result);
    }

    /** @test */
    public function it_converts_to_json_fluently()
    {
        $result = $this->numto->number(12345)->toJson();

        $this->assertIsString($result);
        $this->assertJson($result);
    }

    /** @test */
    public function it_converts_to_string_automatically()
    {
        $fluent = $this->numto->number(12345)
            ->toBangla();

        $result = (string) $fluent;

        $this->assertEquals('১২৩৪৫', $result);
    }
}
