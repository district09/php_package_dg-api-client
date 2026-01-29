<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Token;

/**
 * Interface for token provider.
 */
interface TokenProviderInterface
{
    /**
     * Retrieve a cached token or fetch a new one.
     *
     * @return string
     *   The access token.
     */
    public function getAccessToken(): string;
}
