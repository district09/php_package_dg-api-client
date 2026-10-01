<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Client\Configuration;

use DigipolisGent\API\Client\Configuration\ApiKeyConfiguration;
use DigipolisGent\API\Client\Configuration\ApiKeyConfigurationInterface;
use DigipolisGent\API\Client\Configuration\ClientConfigurationInterface;
use DigipolisGent\API\Client\Configuration\LegacyConfiguration;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(ApiKeyConfiguration::class)]
#[CoversClass(LegacyConfiguration::class)]
final class AuthenticationConfigurationTest extends TestCase
{
    #[Test]
    public function legacyConfigurationMatchesVersionThreeDefaults(): void
    {
        $configuration = new LegacyConfiguration('https://api.example');
        self::assertInstanceOf(ClientConfigurationInterface::class, $configuration);
        self::assertSame('https://api.example', $configuration->getUri());
        self::assertSame('1', $configuration->getVersion());
        self::assertSame(20, $configuration->getTimeout());
    }

    #[Test]
    public function apiKeyConfigurationExposesCredentialsAndDefaults(): void
    {
        $configuration = new ApiKeyConfiguration('https://api.example', 'key', 'application');
        self::assertInstanceOf(ApiKeyConfigurationInterface::class, $configuration);
        self::assertSame('https://api.example', $configuration->getUri());
        self::assertSame('key', $configuration->getApiKey());
        self::assertSame('application', $configuration->getApplicationId());
        self::assertSame('1', $configuration->getVersion());
        self::assertSame(20, $configuration->getTimeout());
    }

    #[Test]
    public function bothConfigurationsSupportOptionsAndIgnoreUnknownKeys(): void
    {
        $options = ['version' => 2, 'timeout' => 10, 'unknown' => 'ignored'];
        $configurations = [
            new LegacyConfiguration('https://api.example', $options),
            new ApiKeyConfiguration('https://api.example', 'key', 'application', $options),
        ];
        foreach ($configurations as $configuration) {
            self::assertSame('2', $configuration->getVersion());
            self::assertSame(10, $configuration->getTimeout());
        }
        $configurations = [
            new LegacyConfiguration('https://api.example', ['unknown' => 'ignored']),
            new ApiKeyConfiguration('https://api.example', 'key', 'application', ['unknown' => 'ignored']),
        ];
        foreach ($configurations as $configuration) {
            self::assertSame('1', $configuration->getVersion());
            self::assertSame(20, $configuration->getTimeout());
        }
    }
}
