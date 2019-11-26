# Changelog

All Notable changes to `digipolisgent/api-client` package.

## [Unreleased]

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
[1.2.0]: https://github.com/digipolisgent/php_package_dg-api-client/compare/1.1.0...1.2.0
[1.1.0]: https://github.com/digipolisgent/php_package_dg-api-client/compare/1.0.0...1.1.0
[1.0.0]: https://github.com/digipolisgent/php_package_dg-api-client/releases/tag/1.0.0
