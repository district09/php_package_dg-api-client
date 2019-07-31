<?php

namespace DigipolisGent\API\Tests\Client\Exception;

use DigipolisGent\API\Client\Exception\HandlerNotFound;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class HandlerNotFoundTest extends TestCase
{

    public function testFromRequest()
    {
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $message = sprintf('No handler was registered for %s', get_class($request));
        $exception = HandlerNotFound::fromRequest($request);
        $this->assertEquals($message, $exception->getMessage());
    }
}
