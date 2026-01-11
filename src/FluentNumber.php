<?php

namespace Rakibhstu\Banglanumber;

/**
 * Fluent API for NumberToBangla
 * Enables method chaining for cleaner syntax
 * 
 * @example 
 * $result = $numto->number(12345)
 *                 ->toBangla()
 *                 ->asWord()
 *                 ->withPrefix('মোট: ')
 *                 ->get();
 */
class FluentNumber
{
    protected int|float|string $number;
    protected NumberToBangla $converter;
    protected string $format = 'number'; // number, word, money
    protected bool $asWord = false;
    protected string $prefix = '';
    protected string $suffix = '';
    protected ?string $result = null;

    public function __construct(int|float|string $number, NumberToBangla $converter)
    {
        $this->number = $number;
        $this->converter = $converter;
    }

    /**
     * Convert to Bangla number format
     */
    public function toBangla(): self
    {
        $this->format = 'number';
        return $this;
    }

    /**
     * Convert to Bangla word format
     */
    public function asWord(): self
    {
        $this->format = 'word';
        return $this;
    }

    /**
     * Convert to Bangla money format
     */
    public function asMoney(): self
    {
        $this->format = 'money';
        return $this;
    }

    /**
     * Convert to percentage format
     */
    public function asPercentage(bool $asWord = false): self
    {
        $this->format = 'percentage';
        $this->asWord = $asWord;
        return $this;
    }

    /**
     * Add prefix to the result
     */
    public function withPrefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Add suffix to the result
     */
    public function withSuffix(string $suffix): self
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * Get the converted result
     */
    public function get(): string
    {
        if ($this->result === null) {
            $this->result = $this->convert();
        }

        return $this->prefix . $this->result . $this->suffix;
    }

    /**
     * Convert based on format
     */
    protected function convert(): string
    {
        return match ($this->format) {
            'number' => $this->converter->bnNum($this->number),
            'word' => $this->converter->bnWord($this->number),
            'money' => $this->converter->bnMoney($this->number),
            'percentage' => $this->converter->bnPercentage((float)$this->number, $this->asWord),
            default => $this->converter->bnNum($this->number),
        };
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return $this->converter->toArray($this->number);
    }

    /**
     * Convert to JSON
     */
    public function toJson(int $flags = JSON_UNESCAPED_UNICODE): string
    {
        return $this->converter->toJson($this->number, $flags);
    }

    /**
     * Automatically convert object to string
     */
    public function __toString(): string
    {
        try {
            return $this->get();
        } catch (\Throwable $e) {
            return '';
        }
    }
}
