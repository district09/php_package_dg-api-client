<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Token;

use Jumbojett\OpenIDConnectClient;
use Psr\SimpleCache\CacheInterface;
use RuntimeException;

/**
 * OIDC token provider.
 */
class OidcTokenProvider implements TokenProviderInterface
{
    /**
     * The OIDC client.
     *
     * @var \Jumbojett\OpenIDConnectClient
     */
    private OpenIDConnectClient $oidc;

    /**
     * The token cache key.
     *
     * @var \Psr\SimpleCache\CacheInterface
     */
    private CacheInterface $cache;

    /**
     * The token cache key.
     *
     * @var string
     */
    private string $cacheKey = 'oidc_access_token';

    /**
     * Token Provider constructor.
     *
     * @param string $authEndpointUri
     *    The authentication endpoint URI.
     * @param string $clientId
     *    The client ID.
     * @param string $clientSecret
     *    The client secret.
     * @param string $scope
     *    The authentication scope.
     * @param \Psr\SimpleCache\CacheInterface $cache
     *    Cache backend.
     */
    public function __construct(
        string $authEndpointUri,
        string $clientId,
        string $clientSecret,
        string $scope,
        CacheInterface $cache,
    ) {
        $this->oidc = new OpenIDConnectClient(
            sprintf(
                '%s://%s',
                parse_url($authEndpointUri, PHP_URL_SCHEME),
                parse_url($authEndpointUri, PHP_URL_HOST)
            ),
            $clientId,
            $clientSecret,
        );

        $this->oidc->providerConfigParam(['token_endpoint' => $authEndpointUri]);
        $this->oidc->addScope([$scope]);
        $this->cache = $cache;
    }

    /**
     * @inheritDoc
     */
    public function getAccessToken(): string
    {
        if ($this->cache->has($this->cacheKey)) {
            return $this->cache->get($this->cacheKey);
        }

        return $this->fetchNewToken();
    }

    /**
     * Fetch a new access token.
     *
     * @return string
     *   The access token.
     * @throws \RuntimeException
     */
    private function fetchNewToken(): string
    {
        $tokenResponse = $this->oidc->requestClientCredentialsToken();

        if (!isset($tokenResponse->access_token)) {
            throw new RuntimeException('Failed to obtain OIDC token.');
        }

        $accessToken = $tokenResponse->access_token;
        // Default expiration to 1 hour.
        $expiresIn = $tokenResponse->expires_in ?? 3600;

        // Cache token with a small buffer before expiration.
        $this->cache->set($this->cacheKey, $accessToken, $expiresIn - 60);

        return $accessToken;
    }
}
