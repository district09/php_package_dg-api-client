<?php

namespace DigipolisGent\API\Tests\Client\Exception;

use DigipolisGent\API\Client\Exception\InvalidResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class InvalidResponseTest extends TestCase
{

    public function testFromResponse()
    {
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $data = ['value' => uniqid()];
        $jsonData = json_encode($data);
        $statusCode = random_int(200, 500);
        $response->expects($this->once())->method('getBody')->willReturn($jsonData);
        $response->expects($this->once())->method('getStatusCode')->willReturn($statusCode);
        $exception = InvalidResponse::fromResponse($response);
        $this->assertContains($jsonData, $exception->getMessage());
        $this->assertContains((string) $statusCode, $exception->getMessage());
        $this->assertEquals($data, $exception->getData());
    }
}
