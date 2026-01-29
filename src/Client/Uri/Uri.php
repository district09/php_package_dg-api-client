<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Uri;

use DigipolisGent\API\Client\Uri\BaseUri;

/**
 * Request URI to be used to communicate with the server endpoint.
 */
class Uri extends BaseUri
{
    /**
     * Construct the URI object from a URI string.
     *
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }
}
