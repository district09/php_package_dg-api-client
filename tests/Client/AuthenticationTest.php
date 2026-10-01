<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Client;

use DigipolisGent\API\Client\AbstractClient;
use DigipolisGent\API\Client\Configuration\ApiKeyConfiguration;
use DigipolisGent\API\Client\Configuration\ClientConfigurationInterface;
use DigipolisGent\API\Client\Configuration\Configuration;
use DigipolisGent\API\Client\Configuration\ConfigurationInterface;
use DigipolisGent\API\Client\Configuration\LegacyConfiguration;
use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\API\Client\Token\TokenProviderInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;

#[CoversClass(AbstractClient::class)]
final class AuthenticationTest extends TestCase
{
    #[Test]
    public function oidcUsesTheCachedBearerToken(): void
    {
        $configuration = new Configuration(
            'https://api.example',
            'https://auth.example/token',
            'id',
            'secret',
            'scope'
        );
        $this->assertOidcRequest($configuration);
    }

    #[Test]
    public function customOidcConfigurationsRemainSupported(): void
    {
        $configuration = $this->createMock(ConfigurationInterface::class);
        $configuration->method('getAuthUri')->willReturn('https://auth.example/token');
        $configuration->method('getClientId')->willReturn('id');
        $configuration->method('getClientSecret')->willReturn('secret');
        $configuration->method('getScope')->willReturn('scope');
        $this->assertOidcRequest($configuration);
    }

    #[Test]
    public function oidcRequiresACache(): void
    {
        $configuration = new Configuration(
            'https://api.example',
            'https://auth.example/token',
            'id',
            'secret',
            'scope'
        );
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('A token cache is required for OIDC authentication.');
        $this->createClient(new Client(), $configuration);
    }

    #[Test]
    public function apiKeyHeadersAreInjectedWithoutACache(): void
    {
        $this->assertOutgoingHeaders(
            new ApiKeyConfiguration('https://api.example', 'key', 'application'),
            ['apiKey' => 'key', 'applicationId' => 'application'],
            new Request('POST', 'https://api.example', [], 'abc')
        );
    }

    #[Test]
    public function legacyAuthenticationHeadersArePreservedWithoutACache(): void
    {
        $this->assertOutgoingHeaders(
            new LegacyConfiguration('https://api.example'),
            ['Authorization' => 'Basic dXNlcjpwYXNz', 'apiKey' => 'legacy-key'],
            new Request('POST', 'https://api.example', [
                'Authorization' => 'Basic dXNlcjpwYXNz',
                'apiKey' => 'legacy-key',
            ], 'abc')
        );
    }

    #[Test]
    public function oidcSubclassesCanKeepTheirProtectedPropertiesAndReplaceTheProvider(): void
    {
        $configuration = new Configuration(
            'https://api.example',
            'https://auth.example/token',
            'id',
            'secret',
            'scope'
        );
        $cache = $this->createMock(CacheInterface::class);
        $cache->expects(self::never())->method('has');
        $provider = $this->createMock(TokenProviderInterface::class);
        $provider->expects(self::once())->method('getAccessToken')->willReturn('replacement');
        $client = new class (new Client(), $configuration, $cache) extends AbstractClient {
            protected ConfigurationInterface $configuration;
            protected TokenProviderInterface $tokenProvider;

            public function configuration(): ConfigurationInterface
            {
                return $this->configuration;
            }

            public function replaceProvider(TokenProviderInterface $provider): void
            {
                $this->tokenProvider = $provider;
            }

            public function prepare(Request $request): \Psr\Http\Message\RequestInterface
            {
                return parent::injectHeaders($request);
            }
        };
        self::assertSame($configuration, $client->configuration());
        $client->replaceProvider($provider);
        $request = $client->prepare(new Request('GET', 'https://api.example'));
        self::assertSame('Bearer replacement', $request->getHeaderLine('Authorization'));
    }

    private function assertOidcRequest(ConfigurationInterface $configuration): void
    {
        $cache = $this->createMock(CacheInterface::class);
        $cache->expects(self::once())->method('has')->with('oidc_access_token')->willReturn(true);
        $cache->expects(self::once())->method('get')->with('oidc_access_token')->willReturn('cached-token');
        $cache->expects(self::never())->method('set');
        $this->assertOutgoingHeaders(
            $configuration,
            ['Authorization' => 'Bearer cached-token'],
            new Request('POST', 'https://api.example', ['Authorization' => 'old'], 'abc'),
            $cache
        );
    }

    private function assertOutgoingHeaders(
        ClientConfigurationInterface $configuration,
        array $headers,
        Request $request,
        ?CacheInterface $cache = null
    ): void {
        $history = [];
        $stack = HandlerStack::create(new MockHandler([new Response(200)]));
        $stack->push(Middleware::history($history));
        $client = $this->createClient(new Client(['handler' => $stack]), $configuration, $cache);
        $response = $this->createMock(ResponseInterface::class);
        $handler = $this->createMock(HandlerInterface::class);
        $handler->method('handles')->willReturn([Request::class]);
        $handler->expects(self::once())->method('toResponse')->willReturn($response);
        $client->addHandler($handler);
        self::assertSame($response, $client->send($request));
        self::assertCount(1, $history);
        $sent = $history[0]['request'];
        foreach ($headers as $name => $value) {
            self::assertSame($value, $sent->getHeaderLine($name));
        }
        self::assertSame('3', $sent->getHeaderLine('Content-Length'));
        self::assertSame('abc', (string) $sent->getBody());
        if ($configuration instanceof ApiKeyConfiguration) {
            self::assertFalse($sent->hasHeader('Authorization'));
        }
        self::assertFalse($request->hasHeader('Content-Length'));
    }

    private function createClient(
        Client $guzzle,
        ClientConfigurationInterface $configuration,
        ?CacheInterface $cache = null
    ): AbstractClient {
        return new class ($guzzle, $configuration, $cache) extends AbstractClient {
        };
    }
}
