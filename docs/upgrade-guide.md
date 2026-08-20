---
layout: default
title: Upgrade Guide
permalink: /upgrade-guide/
---

# Upgrade Guide

## From 2.0 to 2.1

No changes are required for normal existing usage. Existing valid integer, float, money, month, batch, and fluent calls remain available.

Update the dependency as usual:

```bash
composer require rakibhstu/number-to-bangla:^2.1
```

## New APIs

Version 2.1 adds:

```php
$number->bnDate('2024-01-15');
$number->bnWeekNumber('2024-01-15');
$number->bnCurrency('1500.25', 'রুপি', 'পয়সা');
$number->bnOrdinal(1);
```

## Behavior improvements in 2.1

- Negative values now work with digit, word, and money conversion.
- Numeric strings preserve decimal digits in `bnNum()` and `bnWord()`.
- Money values are rounded to two decimal places.
- Large values use additional South Asian number scales.
- Invalid scientific notation and malformed numeric values are rejected.
- Money output no longer contains trailing whitespace.

## Validation changes

Inputs such as `1e3`, `1E3`, `abc`, booleans, and malformed decimal strings are now rejected with `InvalidNumber`.

Invalid times such as `25:61` throw `InvalidTime`. Invalid dates and unsupported `bnDate()` formats throw `InvalidDate`.

If an application previously relied on malformed values being silently accepted, normalize those values before passing them to the package.

## Compatibility notes

- Existing Bengali vocabulary and spellings are preserved, including `জানুয়ারি` and `পয়সা`.
- The supported maximum integer remains `999999999999999`.
- `parseNum()` continues to parse Bangla digits only; Bangla word parsing is not included yet.
