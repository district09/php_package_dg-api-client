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
    protected $data = [];

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
        $statusCode = $response->getStatusCode();

        return new static(
            sprintf(
                'Response with status code %s was unexpected : \'%s\'',
                $statusCode,
                $body
            ),
            $data,
            $statusCode
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
