<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Handler;

use DigipolisGent\API\Client\Response\ResponseInterface;
use Psr\Http\Message as Psr;

/**
 * Handlers transform PSR7-Response object to Api Client Response objects
 */
interface HandlerInterface
{
    /**
     * Returns the Request class names this handler handles.
     *
     * eg:
     * <code>
     * return [AuthRequest::class];
     * </code>
     *
     * @return string[]
     */
    public function handles(): array;

    /**
     * Converts a Psr\Response from the http client to the Api Client Response.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \DigipolisGent\API\Client\Response\ResponseInterface
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface;
}
