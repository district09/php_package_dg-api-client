<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Exception;

use Psr\Http\Message\RequestInterface;

/**
 * Exception thrown when no handler is found for the given request.
 */
class HandlerNotFound extends Handler
{
    /**
     * @param RequestInterface $request
     *
     * @return \DigipolisGent\API\Client\Exception\HandlerNotFound
     */
    public static function fromRequest(RequestInterface $request): HandlerNotFound
    {
        return new self(sprintf('No handler was registered for %s', get_class($request)));
    }
}
