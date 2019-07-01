<?php

namespace DigipolisGent\API\Client\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Class InvalidResponse
 *
 * @package DigipolisGent\API\Client\Exception
 */
class InvalidResponse extends Exception
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * InvalidResponse constructor.
     *
     * @param string $message
     * @param array $data
     */
    public function __construct($message, array $data = [], $code = 0)
    {
        $this->data = $data;
        parent::__construct($message, $code);
    }

    /**
     * Generates an Exception with a uniform message
     *
     * @param ResponseInterface $response
     * @return static
     */
    public static function fromResponse(ResponseInterface $response)
    {
        $body = (string)$response->getBody();
        $data = json_decode($body, true);

        return new static(
            sprintf(
                'Response with status code %s was unexpected : \'%s\'',
                $response->getStatusCode(),
                $body
            ),
            $data,
            $response->getStatusCode()
        );
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
