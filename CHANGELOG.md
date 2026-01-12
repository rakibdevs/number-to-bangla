# Changelog

All notable changes to `number-to-bangla` will be documented in this file.

## [v2.0.0] - 2026-01-12

### Added
- Added new methods: `bnPercentage`, `parseNum`, `bnDay`, `bnTime`, `bnDuration`, `bnBengaliMonth`, `bnSeason`, `bnAge`
- Introduced batch processing functionality
- Added fluent API for method chaining
- Support for Laravel 9.x, 10.x, 11.x, and 12.x
- Support for PHP 8.0, 8.1, 8.2, 8.3, and 8.4
- GitHub Actions CI workflow for automated testing
- Updated PHPUnit configuration for modern versions
- Modern testing setup with Orchestra Testbench

### Changed
- **BREAKING:** Dropped support for Laravel versions below 9.x
- **BREAKING:** Dropped support for PHP versions below 8.0
- Updated all dependencies to support latest Laravel versions
- Improved package auto-discovery configuration
- Modernized service provider implementation

### Removed
- Support for Laravel 5.x, 6.x, 7.x, and 8.x
- Support for PHP 7.x

## [v1.5.0] - 2023-01-13

### Previous Release
- Support for Laravel 5.5+
- Basic number to Bangla conversion features

---

## Upgrade Guide

### Upgrading from v1.x to v2.x

#### Requirements
- Update your PHP version to 8.0 or higher
- Update your Laravel version to 9.0 or higher

#### Steps

1. Update your `composer.json`:
```bash
composer require rakibhstu/number-to-bangla:^2.0
```

2. Clear your config and cache:
```bash
php artisan config:clear
php artisan cache:clear
```

3. If you manually registered the service provider in `config/app.php`, you can remove it as the package now uses auto-discovery.

#### Breaking Changes

- PHP 7.x is no longer supported
- Laravel 8.x and below are no longer supported
- If you were using any deprecated methods, they may have been removed

The API remains the same, so your existing code using the package should continue to work without modifications.