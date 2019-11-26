<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Exception thrown when the response has invalid data.
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
     * @param int $code
     */
    public function __construct(string $message, array $data = [], $code = 0)
    {
        $this->data = $data;
        parent::__construct($message, $code);
    }

    /**
     * Generates an Exception with a uniform message from a given request.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \DigipolisGent\API\Client\Exception\InvalidResponse
     */
    public static function fromResponse(ResponseInterface $response): InvalidResponse
    {
        $body = (string) $response->getBody();
        $data = json_decode($body, true);
        $statusCode = $response->getStatusCode();

        return new static(
            sprintf(
                'Response with status code %s was unexpected : "%s".',
                $statusCode,
                $body
            ),
            $data,
            $statusCode
        );
    }

    /**
     * Get the data that was stored into the exception.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
