<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * Exception thrown when the response is invalid.
 */
class InvalidResponse extends Exception
{
    /**
     * @var string
     */
    protected $body;

    /**
     * InvalidResponse constructor.
     *
     * @param string $message
     * @param string $body
     * @param int $code
     */
    public function __construct(string $message, $body = '', $code = 0)
    {
        $this->body = $body;
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
        $statusCode = $response->getStatusCode();
        return new static(
            sprintf(
                'Response with status code %s was unexpected : "%s".',
                $statusCode,
                $body
            ),
            $body,
            $statusCode
        );
    }

    /**
     * Get the response body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
}
