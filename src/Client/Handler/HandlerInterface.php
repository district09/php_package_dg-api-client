<?php

namespace DigipolisGent\API\Client\Handler;

use DigipolisGent\API\Client\Response\ResponseInterface;
use Psr\Http\Message as Psr;

/**
 * Handlers transform PSR7-Response object to GentServices Response objects
 *
 * @package DigipolisGent\API\Client\Handler
 */
interface HandlerInterface
{
    /**
     * Returns the classnames of the request this handler handles
     *      eg: [AuthRequest::class]
     *
     * @return string[]
     */
    public function handles();

    /**
     * Converts a Psr\Response given by the http client to the corresponding Gent\Response
     *
     * @param Psr\ResponseInterface $response
     * @return ResponseInterface
     */
    public function toResponse(Psr\ResponseInterface $response);
}
