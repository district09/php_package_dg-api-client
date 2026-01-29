<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Client\Configuration;

use DigipolisGent\API\Client\Configuration\Configuration;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\API\Client\Configuration\Configuration
 */
class ConfigurationTest extends TestCase
{
    /**
     * Configuration can be created without options.
     */
    #[Test]
    public function configurationCanBeCreatedWithoutOptions(): void
    {
        $endpointUri = 'https://test-endpoint.gent';
        $authEndpointUri = 'https://auth-endpoint.gent';
        $clientId = 'client-id';
        $clientSecret = 'client-secret';
        $scope = 'scope';

        $configuration = new Configuration(
            $endpointUri,
            $authEndpointUri,
            $clientId,
            $clientSecret,
            $scope,
        );

        $this->assertSame($endpointUri, $configuration->getUri(), 'Endpoint URI is set.');
        $this->assertSame($authEndpointUri, $configuration->getAuthUri(), 'Auth endpoint URI is set.');
        $this->assertSame($clientId, $configuration->getClientId(), 'Client ID is set.');
        $this->assertSame($clientSecret, $configuration->getClientSecret(), 'Client secret is set.');
        $this->assertSame($scope, $configuration->getScope(), 'Scope is set.');

        $this->assertSame('1', $configuration->getVersion(), 'Default version is "1".');
        $this->assertSame(20, $configuration->getTimeout(), 'Default timeout is 20s.');
    }

    /**
     * Configuration can be created with options.
     */
    #[Test]
    public function configurationCanBeCreatedWithOptions(): void
    {
        $endpointUri = 'https://foo.com';
        $authEndpointUri = 'https://auth.foo.com';
        $clientId = 'client-id';
        $clientSecret = 'client-secret';
        $scope = 'scope';

        $options = [
            'version' => 2,
            'timeout' => 10,
            'foo' => 'bar',
        ];

        $configuration = new Configuration(
            $endpointUri,
            $authEndpointUri,
            $clientId,
            $clientSecret,
            $scope,
            $options,
        );

        $this->assertSame('2', $configuration->getVersion(), 'Version is set to custom value.');
        $this->assertSame(10, $configuration->getTimeout(), 'Timeout is set to custom value.');
    }

    /**
     * Unknown options are ignored.
     */
    #[Test]
    public function unknownOptionsAreIgnored(): void
    {
        $configuration = new Configuration(
            'https://foo.com',
            'https://auth.foo.com',
            'client-id',
            'client-secret',
            'scope',
            [
                'foo' => 'bar',
            ],
        );

        $this->assertSame('1', $configuration->getVersion(), 'Default version remains when unknown options are passed.');
        $this->assertSame(20, $configuration->getTimeout(), 'Default timeout remains when unknown options are passed.');
    }
}
