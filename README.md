# Number to Bangla Number, Word or Month Name in Laravel

[![Packagist](https://img.shields.io/packagist/dt/rakibhstu/number-to-bangla)](https://packagist.org/packages/rakibhstu/number-to-bangla)
[![GitHub stars](https://img.shields.io/github/stars/rakibdevs/number-to-bangla)](https://github.com/rakibdevs/number-to-bangla/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/rakibdevs/number-to-bangla)](https://github.com/rakibdevs/number-to-bangla/network)
[![GitHub issues](https://img.shields.io/github/issues/rakibdevs/number-to-bangla)](https://github.com/rakibdevs/number-to-bangla/issues)
[![GitHub license](https://img.shields.io/github/license/rakibdevs/number-to-bangla)](https://github.com/rakibdevs/number-to-bangla/blob/master/LICENSE)
[![Tests](https://github.com/rakibdevs/number-to-bangla/workflows/Tests/badge.svg)](https://github.com/rakibdevs/number-to-bangla/actions)

Laravel package to convert English numbers to Bangla number or Bangla text, Bangla month name and Bangla Money Format for **Laravel 9.x, 10.x, 11.x, and 12.x**. 

Maximum possible number to convert in Bangla word is **999999999999999**

[Get Wordpress Plugin](https://wordpress.org/plugins/number-to-bangla/)

## Features

| Operation | English Input | Bangla Output |
| --- | --- | --- |
| Text (Integer) | 13459 | তেরো হাজার চার শত ঊনষাট |
| Text (Float) | 1345.05 | এক হাজার তিন শত পঁয়তাল্লিশ দশমিক শূন্য পাঁচ |
| Number | 1345.5 | ১৩৪৫.৫ |
| Text Money Format | 1345.50 | এক হাজার তিন শত পঁয়তাল্লিশ টাকা পঞ্চাশ পয়সা |
| Month | 12 | ডিসেম্বর |
| Comma (Lakh) | 121212121 | ১২,১২,১২,১২১ |

## Requirements

- PHP 8.0 or higher
- Laravel 9.x, 10.x, 11.x, or 12.x

# Complete Usage Guide - NumberToBangla v2.0

## 🚀 Installation

```bash
composer require rakibhstu/number-to-bangla:^2.0
```

## 📖 Table of Contents

1. [Basic Number Conversion](#basic-number-conversion)
2. [Date & Time](#date--time)
3. [Advanced Features](#advanced-features)
4. [Reverse Parsing](#reverse-parsing)
5. [Fluent API](#fluent-api)

---

## Basic Number Conversion

### Number to Bangla Digits
```php
use Rakibhstu\Banglanumber\NumberToBangla;

$numto = new NumberToBangla();

echo $numto->bnNum(12345);
// Output: ১২৩৪৫

echo $numto->bnNum(1234.56);
// Output: ১২৩৪.৫৬
```

### Number to Bangla Words
```php
echo $numto->bnWord(12345);
// Output: বারো হাজার তিন শত পঁয়তাল্লিশ

echo $numto->bnWord(1345.05);
// Output: এক হাজার তিন শত পঁয়তাল্লিশ দশমিক শূন্য পাঁচ
```

### Comma Separated (Lakh Format)
```php
echo $numto->bnCommaLakh(1234567);
// Output: ১২,৩৪,৫৬৭
```

### Percentage
```php
echo $numto->bnPercentage(75.5);
// Output: ৭৫.৫%

echo $numto->bnPercentage(75.5, asWord: true);
// Output: পঁচাত্তর দশমিক পাঁচ শতাংশ
```
---

## Currency Formatting

### Money Format (Taka/Paisa)
```php
echo $numto->bnMoney(5000);
// Output: পাঁচ হাজার টাকা

echo $numto->bnMoney(5000.50);
// Output: পাঁচ হাজার টাকা পঞ্চাশ পয়সা
```

---

## Date & Time

### Month Names
```php
echo $numto->bnMonth(1);
// Output: জানুয়ারি

echo $numto->bnMonth(12);
// Output: ডিসেম্বর
```

### Day Names
```php
echo $numto->bnDay(1);
// Output: রবিবার

echo $numto->bnDay('monday');
// Output: সোমবার
```

### Time Formatting
```php
echo $numto->bnTime('14:30');
// Output: দুপুর ২:৩০

echo $numto->bnTime('14:30', asWord: true);
// Output: দুপুর দুইটা ত্রিশ মিনিট

echo $numto->bnTime('09:15', asWord: true);
// Output: সকাল নয়টা পনেরো মিনিট
```

### Duration
```php
echo $numto->bnDuration(3665);
// Output: ১ ঘন্টা ১ মিনিট ৫ সেকেন্ড

echo $numto->bnDuration(90);
// Output: ১ মিনিট ৩০ সেকেন্ড
```

### Bengali Calendar
```php
echo $numto->bnBengaliMonth(1);
// Output: বৈশাখ

echo $numto->bnSeason(1);
// Output: গ্রীষ্ম

echo $numto->bnSeason(5);
// Output: শীত
```

### Age Calculator
```php
echo $numto->bnAge('1990-01-15');
// Output: ৩৫ বছর

echo $numto->bnAge('1990-01-15', detailed: true);
// Output: ৩৫ বছর ২ মাস ৫ দিন
```

### Date Formatting
```php
echo $numto->bnDate('2024-01-15');
// Output: ১৫ জানুয়ারি, ২০২৪

---
## Reverse Parsing

### Parse Bangla Numbers to English
```php
$number = $numto->parseNum('১২৩৪৫');
// Output: 12345

$number = $numto->parseNum('১২,৩৪,৫৬৭');
// Output: 1234567
```

## Fluent API

### Beautiful Chaining
```php
$result = $numto->number(12345)
                ->toBangla()
                ->asWord()
                ->withPrefix('মোট: ')
                ->withSuffix(' টাকা')
                ->get();
// Output: মোট: বারো হাজার তিন শত পঁয়তাল্লিশ টাকা
```

### Different Formats
```php
// As percentage
$result = $numto->number(75.5)
                ->asPercentage(asWord: true)
                ->get();
// Output: পঁচাত্তর দশমিক পাঁচ শতাংশ

```

## Batch Processing

### Convert Multiple Numbers
```php
$numbers = [100, 200, 300];
$result = $numto->batch($numbers, 'bnNum');
// Output: ['১০০', '২০০', '৩০০']

$result = $numto->batch($numbers, 'bnWord');
// Output: ['এক শত', 'দুই শত', 'তিন শত']
```

### With Associative Arrays
```php
$data = [
    'revenue' => 500000,
    'expenses' => 200000,
    'profit' => 300000
];

$result = $numto->batchWithKeys($data, 'bnCurrency');
// Output: [
//   'revenue' => '৫ লক্ষ টাকা',
//   'expenses' => '২ লক্ষ টাকা',
//   'profit' => '৩ লক্ষ টাকা'
// ]
```

---

## API Integration

### Convert to Array
```php
$result = $numto->toArray(12345);
/* Output:
[
    'original' => 12345,
    'bangla_number' => '১২৩৪৫',
    'bangla_word' => 'বারো হাজার তিন শত পঁয়তাল্লিশ',
    'money_format' => 'বারো হাজার তিন শত পঁয়তাল্লিশ টাকা',
    'comma_format' => '১২,৩৪৫'
]
*/
```

### Convert to JSON
```php
$json = $numto->toJson(12345);
// Returns UTF-8 encoded JSON string
```

### In API Controllers
```php
public function show($id)
{
    $product = Product::find($id);
    
    return response()->json([
        'name' => $product->name,
        'price' => NumberToBangla::convert($product->price),
        'price_words' => NumberToBangla::words($product->price),
        'discount' => [
            'rate' => app(NumberToBangla::class)->bnPercentage($product->discount),
            'amount' => NumberToBangla::money($product->discount_amount)
        ],
        'details' => app(NumberToBangla::class)->toArray($product->price)
    ]);
}
```

---

## Static Helpers

### Quick One-Liners
```php
use Rakibhstu\Banglanumber\NumberToBangla;

// In controllers
$banglaNumber = NumberToBangla::convert(12345);

// In Blade
{{ NumberToBangla::words($amount) }}
{{ NumberToBangla::money($total) }}

// In models
public function getPriceAttribute($value)
{
    return NumberToBangla::convert($value);
}
```

## Real-World Use Cases

### E-Commerce
```php
$discount = $numto->bnPercentage(20);
$final = $numto->bnMoney(20000);

// Stock display
$stock = $numto->bnWord(50) . ' পিস';
```

### Education
```php
$marks = $numto->bnNum(85);
$percentage = $numto->bnPercentage(85);
```

### Official
```php
// Official documents
$amount = $numto->bnMoney(50000);
$date = $numto->bnDate('2024-01-15');
$age = $numto->bnAge('1990-01-01');
```


---

## Performance Tips

1. **Batch Processing**: Use `batch()` for multiple conversions
2. **Static Helpers**: Use for simple, one-off conversions
3. **Fluent API**: Chain multiple operations efficiently


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email rakib1708@gmail.com instead of using the issue tracker.

## Credits

- [Rakibul Islam](https://github.com/rakibdevs)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Support

If you find this package helpful, please consider giving it a ⭐ on [GitHub](https://github.com/rakibdevs/number-to-bangla)!