## Number to Bangla Number, Word or Month Name in Laravel 

![Packagist](https://img.shields.io/packagist/dt/rakibhstu/number-to-bangla)
[![GitHub stars](https://img.shields.io/github/stars/rakibul-dev/number-to-bangla)](https://github.com/rakibhstu/number-to-bangla/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/rakibul-dev/number-to-bangla)](https://github.com/rakibhstu/number-to-bangla/network)
[![GitHub issues](https://img.shields.io/github/issues/rakibul-dev/number-to-bangla)](https://github.com/rakibhstu/number-to-bangla/issues)
[![GitHub license](https://img.shields.io/github/license/rakibul-dev/number-to-bangla)](https://github.com/rakibhstu/number-to-bangla/blob/master/LICENSE)
[![MadeWithLaravel.com shield](https://madewithlaravel.com/storage/repo-shields/2818-shield.svg)](https://madewithlaravel.com/p/number-to-bangla/shield-link) | [Get Wordpress Plugin](https://wordpress.org/plugins/number-to-bangla/)


Laravel package to convert English numbers to Bangla number or Bangla text, Bangla month name and Bangla Money Format for Laravel 5.5+. Maximum possible number to covert in Bangla word is 999999999999999
Example,
| Operation | English Input | Bangla Output |
| --- | --- | --- |
| Text (Integer) | 13459 |তেরো হাজার চার শত ঊনষাট|
| Text (Float) | 1345.05 |এক হাজার তিন শত পঁয়তাল্লিশ দশমিক শূন্য পাঁচ|
| Number | 1345.5 |১৩৪৫.৫|
| Text Money Format | 1345.50 |এক হাজার তিন শত পঁয়তাল্লিশ টাকা পঞ্চাশ পয়সা|
| Month | 12 |ডিসেম্বর|
| Comma (Lakh) | 121212121 |১২,১২,১২,১২১|


## Installation

Install the package through [Composer](http://getcomposer.org).
On the command line:

```
composer require rakibhstu/number-to-bangla

```


## Configuration 
If Laravel > 7, no need to add provider

Add the following to your `providers` array in `config/app.php`:

```php
'providers' => [
    // ...

    Rakibhstu\Banglanumber\NumberToBanglaServiceProvider::class,
],
```

## Usage
Here you can see some example of just how simple this package is to use.

```php
use Rakibhstu\Banglanumber\NumberToBangla;

$numto = new NumberToBangla();

// If you want to convert any number (Integer of Float) into Bangla Word
$text = $numto->bnWord(13459);    // Output:  তেরো হাজার চার শত ঊনষাট
$text = $numto->bnWord(1345.05);  // Output:  এক হাজার তিন শত পঁয়তাল্লিশ দশমিক শূন্য পাঁচ


```
### Number to Bangla Word 
Use `bnWord()` to convert any number into bangla word. Example,

```php

// Integer
$text = $numto->bnWord(13459);    // Output:  তেরো হাজার চার শত ঊনষাট

// Float
$text = $numto->bnWord(1345.05);    // Output: এক হাজার তিন শত পঁয়তাল্লিশ দশমিক শূন্য পাঁচ
$text = $numto->bnWord(345675.105); // Output: তিন লক্ষ পঁয়তাল্লিশ হাজার ছয় শত পঁচাত্তর দশমিক এক শূন্য পাঁচ


```

### Number to Bangla Money Format
Use `bnMoney()` to convert any number into bangla money format with 'টাকা' & 'পয়সা'. Example,

```php
$text = $numto->bnMoney(13459);     // Output:  তেরো হাজার চার শত ঊনষাট টাকা
$text = $numto->bnMoney(13459.05);  // Output:  তেরো হাজার চার শত ঊনষাট টাকা পাঁচ পয়সা
$text = $numto->bnMoney(13459.5);   // Output:  তেরো হাজার চার শত ঊনষাট টাকা পঞ্চাশ পয়সা

```

### Number to Bangla Number
Use `bnNum()` to convert any number into bangla number. Example,

```php
$text = $numto->bnNum(13459);    // Output:  ১৩৪৫৯
$text = $numto->bnNum(2334.768); // Output:  ২৩৩৪.৭৬৮

```

### Number to Month Name in Bangla
Use `bnMonth()` to convert any number into bangla number. Input Limit (1-12) Example,

```php
$text = $numto->bnMonth(1);    // Output:  জানুয়ারি 
$text = $numto->bnMonth(4);    // Output:  এপ্রিল

```

### Comma separated number
Use `bnCommaLakh()` to convert any number into bangla number. Example,

```php
$text = $numto->bnCommaLakh(12121212);    // Output:  ১,২১,২১,২১২
```


## License

Number to Bangla is licensed under [The MIT License (MIT)](LICENSE).

