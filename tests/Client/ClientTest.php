<?php

declare(strict_types=1);

namespace DigipolisGent\API\Tests\Client;

use DigipolisGent\API\Client\AbstractClient;
use DigipolisGent\API\Client\Configuration\Configuration;
use DigipolisGent\API\Client\Exception\HandlerNotFound;
use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\ClientException;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * @covers \DigipolisGent\API\Client\AbstractClient
 */
class ClientTest extends TestCase
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $guzzle;

    /**
     * @var string
     */
    protected $endpointUri;

    /**
     * @var \DigipolisGent\API\Client\Configuration\Configuration
     */
    protected $configuration;

    /**
     * @var \Psr\Http\Message\RequestInterface
     */
    protected $request;

    /**
     * @var \DigipolisGent\API\Client\Handler\HandlerInterface
     */
    protected $handler;

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $psrResponse;

    /**
     * @var \DigipolisGent\API\Client\Response\ResponseInterface
     */
    protected $response;

    protected function setUp(): void
    {
        parent::setUp();

        $this->endpointUri = 'https://' . uniqid() . '.com';
        $this->configuration = new Configuration($this->endpointUri);

        $response = $this->prophesize(ResponseInterface::class);
        $this->response = $response->reveal();

        $psrResponse = $this->prophesize(PsrResponseInterface::class);
        $this->psrResponse = $psrResponse->reveal();

        $request = $this->prophesize(RequestInterface::class);
        $request->getBody()->willReturn('123');
        $request->withHeader('Content-Length', 3)->willReturn($request->reveal());
        $this->request = $request->reveal();

        $guzzle = $this->prophesize(GuzzleClientInterface::class);
        $guzzle->send(Argument::any())->willReturn($this->psrResponse);
        $this->guzzle = $guzzle->reveal();

        $handler = $this->prophesize(HandlerInterface::class);
        $handler->handles()->willReturn([get_class($this->request)]);
        $handler->toResponse($this->psrResponse)->willReturn($this->response);
        $this->handler = $handler->reveal();
    }

    /**
     * Exception is thrown when client gets request that cannot be handled.
     *
     * @test
     */
    public function exceptionIsThrownWhenRequestHasNoHandlers(): void
    {
        $client = $this->getMockForAbstractClass(
            AbstractClient::class,
            [$this->guzzle, $this->configuration]
        );

        $this->expectException(HandlerNotFound::class);
        $client->send($this->request);
    }

    /**
     * Client sends request and returns handler response.
     *
     * @test
     */
    public function handlerProcessesResponse(): void
    {
        $client = $this->getMockForAbstractClass(
            AbstractClient::class,
            [$this->guzzle, $this->configuration]
        );
        $client->addHandler($this->handler);

        $this->assertEquals($this->response, $client->send($this->request));
    }

    /**
     * Client exception is captured in response.
     *
     * @test
     */
    public function guzzleExceptionIsCapturedInResponse(): void
    {
        $exception = new ClientException('', $this->request, $this->psrResponse);
        $guzzle = $this->prophesize(GuzzleClientInterface::class);
        $guzzle->send(Argument::any())->willThrow($exception);

        $client = $this->getMockForAbstractClass(
            AbstractClient::class,
            [$guzzle->reveal(), $this->configuration]
        );
        $client->addHandler($this->handler);

        $this->assertEquals($this->response, $client->send($this->request));
    }
}
