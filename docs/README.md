---
layout: default
title: Documentation
permalink: /documentation/
---

# Number to Bangla Documentation

This directory contains the detailed documentation for `rakibhstu/number-to-bangla`.

## Guides

- [API Reference]({{ '/api/' | relative_url }})
- [Upgrade Guide]({{ '/upgrade-guide/' | relative_url }})

## Supported versions

- PHP 8.0–8.4
- Laravel 9.x–12.x

## Quick start

```bash
composer require rakibhstu/number-to-bangla
```

```php
use Rakibhstu\Banglanumber\NumberToBangla;

$converter = app(NumberToBangla::class);

echo $converter->bnNum(12345);
// ১২৩৪৫

echo $converter->bnWord(12345);
// তেরো হাজার চার শত ঊনষাট

echo $converter->bnMoney('12345.50');
// তেরো হাজার চার শত ঊনষাট টাকা পঞ্চাশ পয়সা
```

## Release documentation

Version 2.1 combines numeric correctness, validation, decimal handling, date formatting, week numbers, currencies, ordinals, stricter time handling, and backward-compatible formatting.

## Enable GitHub Pages

The repository includes a GitHub Actions workflow at `.github/workflows/docs.yml`.

In GitHub, open **Settings → Pages** and set **Source** to **GitHub Actions**. After the workflow completes, the site will be available at:

```text
https://rakibdevs.github.io/number-to-bangla/
```

The workflow deploys automatically when documentation changes are pushed to `main` or `master`. It can also be started manually from the **Actions** tab.
