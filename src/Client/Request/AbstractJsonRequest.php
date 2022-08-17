<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Request;

use DigipolisGent\API\Client\Uri\UriInterface;
use GuzzleHttp\Psr7\Request;

/**
 * Abstract request requesting JSON response.
 */
abstract class AbstractJsonRequest extends Request
{
    /**
     * Constructor.
     *
     * @param \DigipolisGent\API\Client\Uri\UriInterface $uri
     *   The URI for the request object.
     */
    public function __construct(UriInterface $uri)
    {
        parent::__construct(
            MethodType::GET,
            $uri->getUri(),
            ['Accept' => AcceptType::JSON]
        );
    }
}
