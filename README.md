[![Stand With Ukraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/banner-direct-single.svg)](https://stand-with-ukraine.pp.ua)

# A Laravel Health check to ssl certification

[![Latest Version on Packagist](https://img.shields.io/packagist/v/victord11/ssl-certification-health-check.svg?style=flat-square)](https://packagist.org/packages/victord11/ssl-certification-health-check)
[![GitHub Tests Action Status](https://github.com/victord11/ssl-certification-health-check/actions/workflows/run-tests.yml/badge.svg)](https://github.com/victord11/ssl-certification-health-check/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://github.com/victord11/ssl-certification-health-check/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/victord11/ssl-certification-health-check/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![PHPStan](https://github.com/victord11/ssl-certification-health-check/actions/workflows/phpstan.yml/badge.svg)](https://github.com/victord11/ssl-certification-health-check/actions/workflows/phpstan.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/victord11/ssl-certification-health-check.svg?style=flat-square)](https://packagist.org/packages/victord11/ssl-certification-health-check)

This package contains a [Laravel Health](https://spatie.be/docs/laravel-health) check that ssl certification valid and soon expired. It can send you a notification when SSL Certification is InValid and Certification soon expiration.

```php
// typically, in a service provider

use Spatie\Health\Facades\Health;
use VictoRD11\SslCertificationHealthCheck\SslCertificationExpiredCheck;
use VictoRD11\SslCertificationHealthCheck\SslCertificationValidCheck;

Health::checks([
    SslCertificationExpiredCheck::new()->url('google.com')->warnWhenSslCertificationExpiringDay(15)->failWhenSslCertificationExpiringDay(10),
    SslCertificationValidCheck::new()->url('google.com'),
]);
```

## Documentation

The documentation of this package is available [inside the docs of Laravel Health](https://spatie.be/docs/laravel-health/v1/available-checks/ssl-certfication).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
