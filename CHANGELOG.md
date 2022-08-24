# Changelog

All Notable changes to `digipolisgent/api-client` package.

## [3.0.1]

### Fixed

* Fix minimal supported Guzzle version: Drupal recommended still uses Guzzle 6.

## [3.0.0]

### Added

* Add PHP8.1 support.

### Changed

* Bumped minimum PHP version to 7.4.
* Bumped minimal Guzzle version to 7.x.

### Updated

* Update qa-php package to 1.x.

## [2.1.0]

### Added

* Add `district09/qa-php` to instal QA tools.
* Add also support for Guzzle 7.x.

## [2.0.0]

### Added

* Added AbstractXmlRequest class.

### Changed

* Made the code strict.
* Renamed the AbstractRequest class to AbstractJsonRequest.
* The client in ServiceAbstract is now only accessible in extending
  classes trough protected method ServiceAbstract::client().

### Removed

* Removed chaining ClientInterface::addHandler() method calls.

## [1.2.0]

### Added

* Added code style checks.

### Changed

* Allow setting a TTL for cache entries.

## [1.1.0]

### Added

* AccepType enum
* MethodType enum
* Uri component
* AbstractRequest
* Allow handlers to support multiple request types
* Code of Conduct
* Security guidelines
* Make the request, not the client, responsible for Accept and Content-Type headers

## [1.0.0]

Initial release of the digipolisgent/api-client package.

This includes:

* PSR-7 client implementation.
* Interfaces to use caching in client packages.
* Interfaces to use logging in client packages.
* Interfaces to create services in client packages.

[Unreleased]: https://github.com/digipolisgent/php_package_dg-api-client/compare/master...develop
[3.0.1]: https://github.com/digipolisgent/php_package_dg-api-client/compare/3.0.0...3.0.1
[3.0.0]: https://github.com/digipolisgent/php_package_dg-api-client/compare/2.1.0...3.0.0
[2.1.0]: https://github.com/digipolisgent/php_package_dg-api-client/compare/2.0.0...2.1.0
[2.0.0]: https://github.com/digipolisgent/php_package_dg-api-client/compare/1.2.0...2.0.0
[1.2.0]: https://github.com/digipolisgent/php_package_dg-api-client/compare/1.1.0...1.2.0
[1.1.0]: https://github.com/digipolisgent/php_package_dg-api-client/compare/1.0.0...1.1.0
[1.0.0]: https://github.com/digipolisgent/php_package_dg-api-client/releases/tag/1.0.0
