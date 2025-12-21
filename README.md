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

## Installation

Install the package through [Composer](http://getcomposer.org):

```bash
composer require rakibhstu/number-to-bangla
```

The package will automatically register itself through Laravel's package discovery.

## Configuration

**For Laravel 9.x, 10.x, 11.x, and 12.x:** No additional configuration needed! The package uses auto-discovery.

**For Laravel 8.x and below:** Add the service provider to `config/app.php`:

```php
'providers' => [
    // ...
    Rakibhstu\Banglanumber\NumberToBanglaServiceProvider::class,
],
```

## Usage

```php
use Rakibhstu\Banglanumber\NumberToBangla;

$numto = new NumberToBangla();

// Convert number to Bangla word
$text = $numto->bnWord(13459);    // Output: তেরো হাজার চার শত ঊনষাট
$text = $numto->bnWord(1345.05);  // Output: এক হাজার তিন শত পঁয়তাল্লিশ দশমিক শূন্য পাঁচ
```

### Number to Bangla Word

Use `bnWord()` to convert any number into Bangla word:

```php
// Integer
$text = $numto->bnWord(13459);
// Output: তেরো হাজার চার শত ঊনষাট

// Float
$text = $numto->bnWord(1345.05);
// Output: এক হাজার তিন শত পঁয়তাল্লিশ দশমিক শূন্য পাঁচ

$text = $numto->bnWord(345675.105);
// Output: তিন লক্ষ পঁয়তাল্লিশ হাজার ছয় শত পঁচাত্তর দশমিক এক শূন্য পাঁচ
```

### Number to Bangla Money Format

Use `bnMoney()` to convert any number into Bangla money format with 'টাকা' & 'পয়সা':

```php
$text = $numto->bnMoney(13459);
// Output: তেরো হাজার চার শত ঊনষাট টাকা

$text = $numto->bnMoney(13459.05);
// Output: তেরো হাজার চার শত ঊনষাট টাকা পাঁচ পয়সা

$text = $numto->bnMoney(13459.5);
// Output: তেরো হাজার চার শত ঊনষাট টাকা পঞ্চাশ পয়সা
```

### Number to Bangla Number

Use `bnNum()` to convert any number into Bangla number:

```php
$text = $numto->bnNum(13459);
// Output: ১৩৪৫৯

$text = $numto->bnNum(2334.768);
// Output: ২৩৩৪.৭৬৮
```

### Number to Month Name in Bangla

Use `bnMonth()` to get Bangla month name. Input range: 1-12

```php
$text = $numto->bnMonth(1);
// Output: জানুয়ারি

$text = $numto->bnMonth(4);
// Output: এপ্রিল
```

### Comma Separated Number

Use `bnCommaLakh()` to format numbers with comma in Bangla style:

```php
$text = $numto->bnCommaLakh(12121212);
// Output: ১,২১,২১,২১২
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email rakibdevs@gmail.com instead of using the issue tracker.

## Credits

- [Rakibul Islam](https://github.com/rakibdevs)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Support

If you find this package helpful, please consider giving it a ⭐ on [GitHub](https://github.com/rakibdevs/number-to-bangla)!