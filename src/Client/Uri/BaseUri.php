<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;

/**
 * Request URI to be used to communicate with the server endpoint.
 */
abstract class BaseUri implements UriInterface
{
    /**
     * The URI string.
     *
     * @var string
     */
    protected string $uri;

    /**
     * @inheritDoc
     */
    public function getUri(): string
    {
        return $this->uri;
    }
}
