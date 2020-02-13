## Number to Bangla Number, Word or Month Name Laravel 5.5+ [![Twitter](https://img.shields.io/twitter/url?style=social&url=https%3A%2F%2Fgithub.com%2Frakibhstu%2Fnumber-to-bangla%2F)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2Frakibhstu%2Fnumber-to-bangla%2F)


[![Twitter](https://img.shields.io/twitter/url?style=social&url=https%3A%2F%2Fpackagist.org%2Fpackages%2Frakibhstu%2Fnumber-to-bangla)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fpackagist.org%2Fpackages%2Frakibhstu%2Fnumber-to-bangla)
[![GitHub stars](https://img.shields.io/github/stars/rakibhstu/number-to-bangla)](https://github.com/rakibhstu/number-to-bangla/stargazers)
[![GitHub license](https://img.shields.io/github/license/rakibhstu/number-to-bangla)](https://github.com/rakibhstu/number-to-bangla/blob/master/LICENSE)

Laravel package to convert English numbers to Bangla number or Bangla text, Bangla month name and Bangla Money Format for Laravel 5.5+.


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

