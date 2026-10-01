# Upgrading from v3 to v4.3

Version 4.3 adds API key headers and a legacy configuration path alongside
OIDC. Existing v4 OIDC consumers need no code or configuration changes.

## Composer requirements

Update the API client requirement in your library or application to:

```json
"digipolisgent/api-client": "^4.3"
```

Do not use `^4.0`: the API key and legacy configuration types require 4.3.
Ensure dependent libraries also accept `^4.3`; a remaining `^3.0` requirement
will prevent Composer from resolving the upgrade.

## What v3 actually did

In v3.0.1, `Configuration` accepted an endpoint URI and options. The base client
added Content-Length but did not authenticate requests. Consumers supplied
API key headers, Guzzle authentication, or their own Authorization headers.
Version 4.0 replaced this configuration with OIDC and required a token cache.
Version 4.3 provides explicit configuration types for all three paths.

## API key headers

Use the new configuration when the service authenticates with the `apiKey`
and `applicationId` headers:

```php
use DigipolisGent\API\Client\Configuration\ApiKeyConfiguration;

$configuration = new ApiKeyConfiguration(
    'https://api.example',
    'your-api-key',
    'your-application-id',
    ['version' => 3, 'timeout' => 10]
);

// Your concrete client extends AbstractClient. No token cache is needed.
$client = new YourClient($guzzle, $configuration);
```

The base client injects these two headers for each request. Remove consumer
code that injects the same headers. Header names are fixed; this is not a
configuration for arbitrary authentication header names.

## Retaining authentication managed by the consumer

Use `LegacyConfiguration` to retain v3 behavior when the consumer handles its
own authentication. It adds no authentication headers and preserves headers
already present on the request.

Before, in v3:

```php
use DigipolisGent\API\Client\Configuration\Configuration as BaseConfiguration;
use DigipolisGent\API\Client\Configuration\ConfigurationInterface as BaseConfigurationInterface;

interface ServiceConfigurationInterface extends BaseConfigurationInterface
{
    public function username(): string;
}

class ServiceConfiguration extends BaseConfiguration implements ServiceConfigurationInterface
{
    // Existing constructor calls parent::__construct($endpointUri, $options).
    // Existing username() implementation is retained.
}
```

After, in v4.3, change only the base imports for this legacy path:

```php
use DigipolisGent\API\Client\Configuration\LegacyConfiguration as BaseConfiguration;
use DigipolisGent\API\Client\Configuration\ClientConfigurationInterface as BaseConfigurationInterface;
```

Retain the consumer's constructor, authentication manager, and header logic.
`LegacyConfiguration($endpointUri, $options)` keeps the v3 defaults: version
`1`, timeout `20`, and ignored unknown options. The base client accepts this
configuration without a token cache.

Update any additional type references that previously accepted the old base
`ConfigurationInterface` to the shared `ClientConfigurationInterface`, or to
your own service configuration interface when service-specific getters are
required. The old name now continues to represent OIDC configuration.

For a service adopting API key headers instead, extend `ApiKeyConfiguration`
and `ApiKeyConfigurationInterface`. Pass endpoint, API key, application ID,
and options to the parent constructor. Retain old getter names as wrappers if
callers depend on them.

## OIDC: unchanged for existing v4 consumers

Keep the existing configuration and cache argument:

```php
use DigipolisGent\API\Client\Configuration\Configuration;

$configuration = new Configuration(
    $endpointUri,
    $authEndpointUri,
    $clientId,
    $clientSecret,
    $scope,
    $options
);
$client = new YourClient($guzzle, $configuration, $tokenCache);
```

OIDC still injects Bearer authentication using the current token provider and
cache behavior. Custom implementations of `ConfigurationInterface` remain
supported, with no new required methods. Omitting the cache for OIDC throws
an `InvalidArgumentException`; there is no automatic authentication fallback.

For existing OIDC subclasses, the protected `$configuration` and
`$tokenProvider` properties retain their original types and initialization.
New API key and legacy subclasses should access the shared protected
`$clientConfiguration` property instead. `$configuration` and `$tokenProvider`
are initialized only for OIDC configurations.
