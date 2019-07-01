<?php
namespace DigipolisGent\API\Logger;

use Psr\Http\Message\ResponseInterface;

class ResponseLog implements LogInterface
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * ResponseLog constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return (string)sprintf(
            "Response \n Status %s \n Headers %s \n Body %s \n \n",
            $this->response->getStatusCode(),
            (string)json_encode($this->response->getHeaders()),
            (string)json_encode($this->response->getBody())
        );
    }
}
