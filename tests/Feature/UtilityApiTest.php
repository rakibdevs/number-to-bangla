<?php

namespace Rakibhstu\Banglanumber\Tests\Feature;

use Rakibhstu\Banglanumber\NumberToBangla;
use Rakibhstu\Banglanumber\Tests\TestCase;

class UtilityApiTest extends TestCase
{
    protected NumberToBangla $numto;

    protected function setUp(): void
    {
        parent::setUp();
        $this->numto = new NumberToBangla();
    }

    /** @test */
    public function it_converts_number_to_array()
    {
        $result = $this->numto->toArray(12345);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('original', $result);
        $this->assertArrayHasKey('bangla_number', $result);
        $this->assertArrayHasKey('bangla_word', $result);
        $this->assertArrayHasKey('money_format', $result);
        $this->assertArrayHasKey('comma_format', $result);

        $this->assertEquals(12345, $result['original']);
        $this->assertEquals('১২৩৪৫', $result['bangla_number']);
    }

    /** @test */
    public function it_converts_number_to_json()
    {
        $result = $this->numto->toJson(12345);

        $this->assertIsString($result);
        $this->assertJson($result);

        $decoded = json_decode($result, true);
        $this->assertArrayHasKey('original', $decoded);
        $this->assertEquals(12345, $decoded['original']);
    }

    /** @test */
    public function it_batch_converts_numbers()
    {
        $numbers = [100, 200, 300];
        $result = $this->numto->batch($numbers, 'bnNum');

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertEquals('১০০', $result[0]);
        $this->assertEquals('২০০', $result[1]);
        $this->assertEquals('৩০০', $result[2]);
    }

    /** @test */
    public function it_batch_converts_to_words()
    {
        $numbers = [5, 10, 15];
        $result = $this->numto->batch($numbers, 'bnWord');

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertIsString($result[0]);
    }

    /** @test */
    public function it_batch_converts_to_money()
    {
        $amounts = [1000, 2000, 3000];
        $result = $this->numto->batch($amounts, 'bnMoney');

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertStringContainsString('টাকা', $result[0]);
    }

    /** @test */
    public function it_batch_converts_with_preserved_keys()
    {
        $data = [
            'price' => 1000,
            'discount' => 100,
            'total' => 900
        ];

        $result = $this->numto->batchWithKeys($data, 'bnNum');

        $this->assertIsArray($result);
        $this->assertArrayHasKey('price', $result);
        $this->assertArrayHasKey('discount', $result);
        $this->assertArrayHasKey('total', $result);
        $this->assertEquals('১০০০', $result['price']);
    }

    /** @test */
    public function it_uses_static_convert_helper()
    {
        $result = NumberToBangla::convert(12345);
        $this->assertEquals('১২৩৪৫', $result);
    }

    /** @test */
    public function it_uses_static_words_helper()
    {
        $result = NumberToBangla::words(123);
        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }

    /** @test */
    public function it_uses_static_money_helper()
    {
        $result = NumberToBangla::money(1000);
        $this->assertStringContainsString('টাকা', $result);
    }
}
