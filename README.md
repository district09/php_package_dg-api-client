# District09 API Client

This package provides interfaces and abstract implementations to create an API client.

[![Latest Stable Version][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-packagist]
[![License][ico-license]][link-license]

[![Build Status][ico-ci]][link-ci]
[![Maintainability][ico-maintainability]][link-maintainability]
[![Test Coverage][ico-test-coverage]][link-test-coverage]
![PHP from Packagist][ico-php-version]

## Install

Install the package:

```bash
composer require digipolisgent/api-client
```

### Requirements

The package supports PHP `^7.4 || ^8.0` and Guzzle `^6.5 || ^7.0 || ^8.0`.
Guzzle 8 support allows consumers such as Drupal 12 to use Guzzle PSR-7 3.x.

## Usage

See the examples of service packages how to use this package:

* [gent/services/openinghours](https://github.com/StadGent/php_package_services-opening-hours)
  : Service to access the Opening Hours API and wrap the responses in value objects.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

Install the development dependencies on PHP 8.3, 8.4, or 8.5:

```shell
composer install
```

Run the complete QA suite:

```shell
composer grumphp
```

Run the PHPUnit suite:

```shell
composer phpunit
```

QA PHP generates the schema-correct PHPUnit 11.5 or 12.5 configuration
automatically. The PHPUnit and coverage scripts run the QA PHP test suite, so
no project-level `phpunit.xml` file is needed. Coverage reports are written to
`build/` when code coverage is available.

## License

The MIT License (MIT).
Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/digipolisgent/api-client.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/digipolisgent/api-client.svg?style=flat-square

[ico-license]: https://img.shields.io/github/license/district09/php_package_dg-api-client.svg?style=flat-square
[ico-ci]: https://github.com/district09/php_package_dg-api-client/actions/workflows/ci.yml/badge.svg?branch=develop
[ico-maintainability]: https://api.codeclimate.com/v1/badges/658619da9e80449755a2/maintainability
[ico-test-coverage]: https://api.codeclimate.com/v1/badges/658619da9e80449755a2/test_coverage
[ico-php-version]: https://img.shields.io/packagist/php-v/digipolisgent/api-client.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/digipolisgent/api-client
[link-license]: LICENSE.md
[link-ci]: https://github.com/district09/php_package_dg-api-client/actions/workflows/ci.yml
[link-maintainability]: https://codeclimate.com/github/district09/php_package_dg-api-client/maintainability
[link-test-coverage]: https://codeclimate.com/github/district09/php_package_dg-api-client/test_coverage
