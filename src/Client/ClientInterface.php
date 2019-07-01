<?php

namespace DigipolisGent\API\Client;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Request\RequestInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;

/**
 * Client Interface.
 *
 * This is a wrapper around the actual used HTTP request (Guzzle, Drupal, …).
 *
 * @package DigipolisGent\API\Client
 */
interface ClientInterface
{
    /**
     * Perform a request to the Gent Services backend.
     *
     * @param RequestInterface $request
     *   The request parameters.
     *
     * @return ResponseInterface
     *   The response of the service call.
     */
    public function send(RequestInterface $request);

    /**
     * Adds a Handler to the Client
     * 
     * @param HandlerInterface $handler
     * @return ClientInterface
     */
    public function addHandler(HandlerInterface $handler);
}
