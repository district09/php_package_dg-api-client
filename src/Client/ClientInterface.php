<?php

namespace DigipolisGent\API\Client;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Client Interface.
 *
 * This is a wrapper around the actual used HTTP request (Guzzle, Drupal, …).
 */
interface ClientInterface
{
    /**
     * Perform a request to the Gent Services backend.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     *   The request to be sent.
     *
     * @return \DigipolisGent\API\Client\Response\ResponseInterface
     *   The response of the service call.
     */
    public function send(RequestInterface $request): ResponseInterface;

    /**
     * Adds a Handler to the Client.
     *
     * @param \DigipolisGent\API\Client\Handler\HandlerInterface $handler
     */
    public function addHandler(HandlerInterface $handler): void;

    /**
     * Get handlers.
     *
     * @return Handler\HandlerInterface[]
     */
    public function getHandlers(): array;
}
