---
layout: default
title: API Reference
permalink: /api/
---

# API Reference

All examples assume:

```php
$number = app(\Rakibhstu\Banglanumber\NumberToBangla::class);
```

## Number conversion

### `bnNum($number)`

Converts numeric input to Bangla digits while preserving decimal digits supplied as a string.

```php
$number->bnNum(12345);       // ১২৩৪৫
$number->bnNum('12.050');    // ১২.০৫০
$number->bnNum(-123);        // -১২৩
```

Supported values must contain a regular decimal number. Scientific notation, malformed values, booleans, and non-numeric values are rejected.

The maximum absolute integer value is `999999999999999`.

### `bnWord($number)`

Converts a number to Bangla words.

```php
$number->bnWord(123);         // এক শত তেইশ
$number->bnWord('12.05');     // বারো দশমিক শূন্য পাঁচ
$number->bnWord(-123);        // ঋণাত্মক এক শত তেইশ
```

Supported South Asian scales include হাজার, লক্ষ, কোটি, আরব, খরব, and নীল.

### `bnCommaLakh($number)`

Formats a number using Bangladesh/India-style lakh grouping.

```php
$number->bnCommaLakh(1234567); // ১২,৩৪,৫৬৭
```

### `bnPercentage($number, $asWord = false)`

```php
$number->bnPercentage(75.5);             // ৭৫.৫%
$number->bnPercentage(75.5, true);       // পঁচাত্তর দশমিক পাঁচ শতাংশ
```

### `bnOrdinal($number)`

Formats common ordinal values.

```php
$number->bnOrdinal(1);  // প্রথম
$number->bnOrdinal(2);  // দ্বিতীয়
$number->bnOrdinal(10); // দশম
```

Values outside the built-in list use the numeric word followed by `তম`.

## Currency

### `bnMoney($number)`

Formats an amount using টাকা and পয়সা. Values are rounded to two decimal places.

```php
$number->bnMoney(5000);       // পাঁচ হাজার টাকা
$number->bnMoney('5000.50');  // পাঁচ হাজার টাকা পঞ্চাশ পয়সা
$number->bnMoney('0.05');     // শূন্য টাকা পাঁচ পয়সা
```

### `bnCurrency($number, $unit = 'টাকা', $subunit = 'পয়সা')`

Uses custom currency labels while retaining the package's number formatting.

```php
$number->bnCurrency('1500.25', 'রুপি', 'পয়সা');
// এক হাজার পাঁচ শত রুপি পঁচিশ পয়সা
```

## Reverse conversion

### `parseNum($banglaNumber)`

Converts Bangla digits back to an integer or float.

```php
$number->parseNum('১২,৩৪,৫৬৭'); // 1234567
$number->parseNum('১২.৫০');     // 12.5
```

Commas, spaces, and the `৳` symbol are ignored. This method parses digits, not Bangla number words.

## Dates and time

### `bnMonth($month)`

```php
$number->bnMonth(1);  // জানুয়ারি
$number->bnMonth(12); // ডিসেম্বর
```

### `bnDay($day)`

Accepts a day number, full English name, or short English name.

```php
$number->bnDay(1);         // রবিবার
$number->bnDay('monday');  // সোমবার
$number->bnDay('fri');     // শুক্রবার
```

### `bnDate($date, $format = 'd F, Y')`

Formats Gregorian dates with Bangla digits and names.

```php
$number->bnDate('2024-01-15');
// ১৫ জানুয়ারি, ২০২৪

$number->bnDate('2024-01-15', 'l, d F Y');
// সোমবার, ১৫ জানুয়ারি ২০২৪
```

Built-in formats:

- `d F, Y`
- `F d, Y`
- `l, d F Y`
- `d/m/Y`

The method also accepts a `DateTimeInterface` instance.

### `bnWeekNumber($date)`

```php
$number->bnWeekNumber('2024-01-15'); // ৩
```

### `bnTime($time, $asWord = false)`

Accepts valid 24-hour `HH:MM` input and returns a Bangla period label.

```php
$number->bnTime('14:30');            // দুপুর ২:৩০
$number->bnTime('14:30', true);      // দুপুর দুইটা ত্রিশ মিনিট
```

Invalid hours or minutes throw `InvalidTime`.

### `bnDuration($seconds)`

```php
$number->bnDuration(3665); // ১ ঘন্টা ১ মিনিট ৫ সেকেন্ড
```

### `bnBengaliMonth($month)` and `bnSeason($season)`

```php
$number->bnBengaliMonth(1); // বৈশাখ
$number->bnSeason(1);       // গ্রীষ্ম
```

### `bnAge($birthDate, $detailed = false)`

```php
$number->bnAge('1990-01-01');
// age in years

$number->bnAge('1990-01-01', true);
// age in years, months, and days
```

Invalid dates throw `InvalidDate`.

## Batch and structured output

```php
$number->batch([100, 200], 'bnNum');
// ['১০০', '২০০']

$number->batchWithKeys(['price' => 1000], 'bnMoney');
// ['price' => 'এক হাজার টাকা']

$number->toArray(12345);
$number->toJson(12345);
```

## Fluent API

```php
$number->number(12345)
    ->asWord()
    ->withPrefix('মোট: ')
    ->withSuffix(' টাকা')
    ->get();
```

Available fluent formats are `toBangla()`, `asWord()`, `asMoney()`, and `asPercentage()`.

## Exceptions

- `InvalidNumber`: malformed numeric input
- `InvalidRange`: value exceeds the supported range
- `InvalidDate`: invalid date input or unsupported date format
- `InvalidTime`: invalid time input
