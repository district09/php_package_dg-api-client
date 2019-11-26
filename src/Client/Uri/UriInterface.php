<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Uri;

/**
 * Interface to describe the request URI.
 */
interface UriInterface
{
    /**
     * Get the URI as string.
     *
     * @return string
     *   The URI string.
     */
    public function getUri(): string;
}
