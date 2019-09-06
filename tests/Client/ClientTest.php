<?php

namespace DigipolisGent\API\Tests\Client;

use DigipolisGent\API\Client\AbstractClient;
use DigipolisGent\API\Client\Configuration\Configuration;
use DigipolisGent\API\Client\Exception\HandlerNotFound;
use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ClientTest extends TestCase
{
    /**
     * @var MockObject|GuzzleClient
     */
    protected $guzzle;

    /**
     * @var string
     */
    protected $endpointUri;

    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @var AbstractClient
     */
    protected $client;

    /**
     * @var MockObject|RequestInterface
     */
    protected $request;

    /**
     * @var MockObject|HandlerInterface
     */
    protected $handler;

    /**
     * @var MockObject|PsrResponseInterface
     */
    protected $psrResponse;

    /**
     * @var MockObject|ResponseInterface
     */
    protected $response;

    protected function setUp(): void
    {
        parent::setUp();

        // Create mocks.
        $this->endpointUri = 'https://' . uniqid() . '.com';
        $this->guzzle = $this->getMockBuilder(GuzzleClient::class)->getMock();
        $this->configuration = new Configuration($this->endpointUri);
        $this->client = $this->getMockForAbstractClass(AbstractClient::class, [$this->guzzle, $this->configuration]);
        $this->request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $this->response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $this->psrResponse = $this->getMockBuilder(PsrResponseInterface::class)->getMock();
        $this->handler = $this->getMockBuilder(HandlerInterface::class)->getMock();

        // Set expectations.
        $this->guzzle->expects($this->any())->method('send')->willReturn($this->psrResponse);
        $this->handler->expects($this->any())->method('handles')->willReturn(get_class($this->request));
        $this->handler->expects($this->any())->method('toResponse')->with($this->psrResponse)->willReturn($this->response);
    }

    public function testSendWithoutHandlers()
    {
        $this->expectException(HandlerNotFound::class);
        $this->request->expects($this->any())->method('withHeader')->willReturnSelf();
        $this->client->send($this->request);
    }

    public function testSendWithHandlers()
    {
        $this->request->expects($this->any())->method('withHeader')->willReturnSelf();
        $this->client->addHandler($this->handler);
        $this->assertEquals($this->response, $this->client->send($this->request));
    }

    public function testFailedSendWithHandlers()
    {
        $this->request->expects($this->any())->method('withHeader')->willReturnSelf();
        $this->client->addHandler($this->handler);
        $exception = new ClientException('', $this->request, $this->psrResponse);
        $this->guzzle->expects($this->any())->method('send')->willThrowException($exception);
        $this->assertEquals($this->response, $this->client->send($this->request));
    }
}
