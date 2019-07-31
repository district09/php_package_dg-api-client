<?php

namespace DigipolisGent\API\Client\Uri;

/**
 * Interface to describe the request URI.
 *
 * @package DigipolisGent\API\Client\Uri
 */
interface UriInterface
{
    /**
     * Get the URI as string.
     *
     * @return string
     *   The URI string.
     */
    public function getUri();
}
