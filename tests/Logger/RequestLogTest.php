<?php

namespace DigipolisGent\API\Tests\Logger;

use DigipolisGent\API\Logger\RequestLog;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class RequestLogTest extends TestCase
{

    public function testToString()
    {
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $method = uniqid();
        $headers = uniqid();
        $uri = uniqid();
        $body = uniqid();
        // Log should contain method, headers, uri and body.
        $request->expects($this->any())->method('getMethod')->willReturn($method);
        $request->expects($this->any())->method('getHeaders')->willReturn($headers);
        $request->expects($this->any())->method('getUri')->willReturn($uri);
        $request->expects($this->any())->method('getBody')->willReturn($body);
        $log = (string)(new RequestLog($request));
        $this->assertContains($method, $log);
        $this->assertContains($headers, $log);
        $this->assertContains($uri, $log);
        $this->assertContains($body, $log);
    }
}
