<?php

declare(strict_types=1);

namespace DigipolisGent\API\Logger;

use Psr\Http\Message\ResponseInterface;

/**
 * Create a log item from a PSR HTTP Response.
 */
class ResponseLog implements LogInterface
{
    /**
     * The response this log item is about.
     *
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * Create the log item from given response.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string)sprintf(
            "Response \n Status %s \n Headers %s \n Body %s \n \n",
            $this->response->getStatusCode(),
            (string) json_encode($this->response->getHeaders()),
            (string) json_encode($this->response->getBody())
        );
    }
}
