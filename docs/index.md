---
layout: home
title: Number to Bangla
description: Complete documentation for the Number to Bangla Laravel package.
permalink: /
---

# Number to Bangla

Convert English numbers, dates, currency, time, and numeric data into Bangla in Laravel applications.

Current documentation covers release **2.1.0**.

## Install

```bash
composer require rakibhstu/number-to-bangla:^2.1
```

## Quick example

```php
use Rakibhstu\Banglanumber\NumberToBangla;

$number = app(NumberToBangla::class);

echo $number->bnNum(12345);
// ১২৩৪৫

echo $number->bnWord(12345);
// তেরো হাজার চার শত ঊনষাট

echo $number->bnMoney('12345.50');
// তেরো হাজার চার শত ঊনষাট টাকা পঞ্চাশ পয়সা
```

## Documentation

- [Complete API reference](api)
- [Upgrade guide](upgrade-guide)
- [Source repository](https://github.com/rakibdevs/number-to-bangla)

## What is included in 2.1.0?

- Bangla digit and word conversion
- Negative numbers and decimal-string preservation
- Money and custom currency formatting
- Lakh/crore and extended South Asian number scales
- Percentages and ordinals
- Bangla dates, months, weekdays, times, durations, and age calculation
- Bengali calendar month and season labels
- Reverse Bangla digit parsing
- Batch, JSON, and fluent APIs
