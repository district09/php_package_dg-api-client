<?php

namespace DigipolisGent\API\Logger;

use Psr\Http\Message\RequestInterface;

class RequestLog implements LogInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * RequestLog constructor.
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return (string)sprintf(
            "Request \n Method %s \n Headers %s \n URI %s \n Body %s \n \n",
            $this->request->getMethod(),
            (string)json_encode($this->request->getHeaders()),
            (string)$this->request->getUri(),
            (string)$this->request->getBody()
        );
    }
}
