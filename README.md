## Number to Bangla Number, Word or Month Name Laravel 5.5+ [![Twitter](https://img.shields.io/twitter/url?style=social&url=https%3A%2F%2Fgithub.com%2Frakibhstu%2Fnumber-to-bangla%2F)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2Frakibhstu%2Fnumber-to-bangla%2F)

[![GitHub stars](https://img.shields.io/github/stars/rakibhstu/number-to-bangla)](https://github.com/rakibhstu/number-to-bangla/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/rakibhstu/number-to-bangla)](https://github.com/rakibhstu/number-to-bangla/network)
[![GitHub issues](https://img.shields.io/github/issues/rakibhstu/number-to-bangla)](https://github.com/rakibhstu/number-to-bangla/issues)
[![GitHub license](https://img.shields.io/github/license/rakibhstu/number-to-bangla)](https://github.com/rakibhstu/number-to-bangla/blob/master/LICENSE)
[![Twitter](https://img.shields.io/twitter/url?style=social&url=https%3A%2F%2Fpackagist.org%2Fpackages%2Frakibhstu%2Fnumber-to-bangla)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fpackagist.org%2Fpackages%2Frakibhstu%2Fnumber-to-bangla)

Laravel package to convert English numbers to Bangla number or Bangla text, Bangla month name and Bangla Money Format for Laravel 5.5+. Maximum possible number to covert in Bangla word is 999999999999999
Example,
| Operation | English Input | Bangla Output |
| --- | --- | --- |
| Text (Integer) | 13459 |তেরো হাজার চার শত ঊনষাট|
| Text (Float) | 1234.05 |এক হাজার তিন শত পঁয়তাল্লিশ দশমিক শূন্য পাঁচ|
| Number | 1234.5 |১৩৪৫.৫|
| Text Money Format | 1345.50 |এক হাজার তিন শত পঁয়তাল্লিশ টাকা পঞ্চাশ পয়সা|
| Month | 12 |ডিসেম্বর|


## Installation

Install the package through [Composer](http://getcomposer.org).
On the command line:

```
composer require rakibhstu/number-to-bangla
```

## Configuration

Add the following to your `providers` array in `config/app.php`:

```php
'providers' => [
    // ...

    Rakibhstu\Banglanumber\NumberToBanglaServiceProvider::class,
],
```

## Usage

