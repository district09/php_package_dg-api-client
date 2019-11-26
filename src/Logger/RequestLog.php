<?php

declare(strict_types=1);

namespace DigipolisGent\API\Logger;

use Psr\Http\Message\RequestInterface;

/**
 * Create a log item from a PSR HTTP Request.
 */
class RequestLog implements LogInterface
{
    /**
     * The request this log item is about.
     *
     * @var \Psr\Http\Message\RequestInterface
     */
    protected $request;

    /**
     * Create new log item from given request.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string) sprintf(
            "Request \n Method %s \n Headers %s \n URI %s \n Body %s \n \n",
            $this->request->getMethod(),
            (string) json_encode($this->request->getHeaders()),
            (string) $this->request->getUri(),
            (string) json_encode($this->request->getBody())
        );
    }
}
