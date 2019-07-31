<?php

namespace DigipolisGent\API\Client\Exception;

use Psr\Http\Message\RequestInterface;

/**
 * Class HandlerNotFound
 *
 * @package DigipolisGent\API\Client\Exception
 */
class HandlerNotFound extends Handler
{
    /**
     * @param RequestInterface $request
     * @return HandlerNotFound
     */
    public static function fromRequest(RequestInterface $request)
    {
        return new self(sprintf('No handler was registered for %s', get_class($request)));
    }
}
