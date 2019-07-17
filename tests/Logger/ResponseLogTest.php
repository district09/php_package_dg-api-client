<?php

namespace DigipolisGent\API\Tests\Logger;

use DigipolisGent\API\Logger\ResponseLog;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ResponseLogTest extends TestCase
{

    public function testToString()
    {
        $request = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $statusCode = uniqid();
        $headers = uniqid();
        $body = uniqid();
        // Log should contain status code, headers and body.
        $request->expects($this->any())->method('getStatusCode')->willReturn($statusCode);
        $request->expects($this->any())->method('getHeaders')->willReturn($headers);
        $request->expects($this->any())->method('getBody')->willReturn($body);
        $log = (string)(new ResponseLog($request));
        $this->assertContains($statusCode, $log);
        $this->assertContains($headers, $log);
        $this->assertContains($body, $log);
    }
}
