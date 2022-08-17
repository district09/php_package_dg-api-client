<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Uri;

/**
 * Request URI to be used to communicate with the server endpoint.
 */
final class Uri implements UriInterface
{
    /**
     * The URI string.
     *
     * @var string
     */
    private string $uri;

    /**
     * Construct the URI object from a URI string.
     *
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * Get the URI as string.
     *
     * @return string
     *   The URI.
     */
    public function getUri(): string
    {
        return $this->uri;
    }
}
