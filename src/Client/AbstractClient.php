<?php

namespace DigipolisGent\API\Client;

use DigipolisGent\API\Client\Configuration\ConfigurationInterface;
use DigipolisGent\API\Client\Exception\HandlerNotFound;
use DigipolisGent\API\Logger\LoggableInterface;
use DigipolisGent\API\Logger\LoggableTrait;
use DigipolisGent\API\Logger\RequestLog;
use DigipolisGent\API\Logger\ResponseLog;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\RequestInterface;

/**
 * Class ClientAbstract.
 *
 * @package DigipolisGent\API\Client

 */
abstract class AbstractClient implements ClientInterface, LoggableInterface
{
    use LoggableTrait;

    /**
     * @var Handler\HandlerInterface[]
     */
    protected $handlers = [];

    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzle;

    /**
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * Client constructor.
     *
     * @param \GuzzleHttp\Client $guzzle
     * @param ConfigurationInterface $configuration
     */
    public function __construct(\GuzzleHttp\Client $guzzle, ConfigurationInterface $configuration)
    {
        $this->guzzle        = $guzzle;
        $this->configuration = $configuration;
    }

    /**
     * Sends a Request and returns the appropriate Response
     *
     * @param RequestInterface $request
     * @return Response\ResponseInterface
     * @throws HandlerNotFound
     */
    public function send(RequestInterface $request)
    {
        $psrRequest  = $this->injectHeaders($request);

        $this->log(new RequestLog($request));

        $handler     = $this->getHandler($request);
        try {
            $psrResponse = $this->guzzle->send($psrRequest);
        } catch (ClientException $e) {
            $psrResponse = $e->getResponse();
        }

        $this->log(new ResponseLog($psrResponse));

        return $handler->toResponse($psrResponse);
    }

    /**
     * Adds headers to a Request object
     *
     * @param RequestInterface $request
     * @return RequestInterface
     */
    protected function injectHeaders(RequestInterface $request)
    {
        return $request
            ->withHeader('Content-Length', strlen((string)$request->getBody()))
        ;
    }

    /**
     * Returns the correct handler for the given Request-object
     *
     * @param RequestInterface $request
     * @return Handler\HandlerInterface
     * @throws HandlerNotFound
     */
    protected function getHandler(RequestInterface $request)
    {
        if (array_key_exists(get_class($request), $this->handlers)) {
            return $this->handlers[get_class($request)];
        }

        throw HandlerNotFound::fromRequest($request);
    }

    /**
     * Registers one handler
     *
     * @param Handler\HandlerInterface $handler
     * @return $this
     */
    public function addHandler(Handler\HandlerInterface $handler)
    {
        $requestTypes = (array) $handler->handles();
        foreach ($requestTypes as $requestType) {
            $this->handlers[$requestType] = $handler;
        }
        return $this;
    }
}
