<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client;

use DigipolisGent\API\Client\Configuration\ConfigurationInterface;
use DigipolisGent\API\Client\Exception\HandlerNotFound;
use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\API\Logger\LoggableInterface;
use DigipolisGent\API\Logger\LoggableTrait;
use DigipolisGent\API\Logger\RequestLog;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\RequestInterface;

/**
 * Abstract implementation of the service client.
 */
abstract class AbstractClient implements ClientInterface, LoggableInterface
{
    use LoggableTrait;

    /**
     * Handlers this client has to handle the requests.
     *
     * @var \DigipolisGent\API\Client\Handler\HandlerInterface[]
     */
    protected $handlers = [];

    /**
     * Guzzle HTTP client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $guzzle;

    /**
     * The client configuration.
     *
     * @var \DigipolisGent\API\Client\Configuration\ConfigurationInterface
     */
    protected $configuration;

    /**
     * Client constructor.
     *
     * @param \GuzzleHttp\ClientInterface $guzzle
     * @param \DigipolisGent\API\Client\Configuration\ConfigurationInterface $configuration
     */
    public function __construct(GuzzleClientInterface $guzzle, ConfigurationInterface $configuration)
    {
        $this->guzzle = $guzzle;
        $this->configuration = $configuration;
    }

    /**
     * Sends a Request and returns the appropriate Response.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \DigipolisGent\API\Client\Response\ResponseInterface
     *
     * @throws \DigipolisGent\API\Client\Exception\HandlerNotFound
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        $psrRequest  = $this->injectHeaders($request);

        $this->log(new RequestLog($request));

        $handler = $this->getHandler($request);
        try {
            $psrResponse = $this->guzzle->send($psrRequest);
        } catch (ClientException $e) {
            $psrResponse = $e->getResponse();
        }

        return $handler->toResponse($psrResponse);
    }

    /**
     * Adds headers to a Request object
     *
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function injectHeaders(RequestInterface $request): RequestInterface
    {
        return $request->withHeader(
            'Content-Length',
            (string) strlen((string) $request->getBody())
        );
    }

    /**
     * Returns the correct handler for the given Request-object
     *
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \DigipolisGent\API\Client\Handler\HandlerInterface
     *
     * @throws \DigipolisGent\API\Client\Exception\HandlerNotFound
     */
    protected function getHandler(RequestInterface $request): HandlerInterface
    {
        if (array_key_exists(get_class($request), $this->handlers)) {
            return $this->handlers[get_class($request)];
        }

        throw HandlerNotFound::fromRequest($request);
    }

    /**
     * Registers a single handler.
     *
     * @param \DigipolisGent\API\Client\Handler\HandlerInterface $handler
     */
    public function addHandler(HandlerInterface $handler): void
    {
        $requestTypes = (array) $handler->handles();
        foreach ($requestTypes as $requestType) {
            $this->handlers[$requestType] = $handler;
        }
    }

    /**
     * Get handlers.
     *
     * @return Handler\HandlerInterface[]
     */
    public function getHandlers()
    {
        return $this->handlers;
    }
}
