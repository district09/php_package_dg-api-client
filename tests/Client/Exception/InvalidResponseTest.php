<?php

declare(strict_types=1);

namespace DigipolisGent\API\Tests\Client\Exception;

use DigipolisGent\API\Client\Exception\InvalidResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\API\Client\Exception\InvalidResponse
 */
class InvalidResponseTest extends TestCase
{
    /**
     * Exception can be created from response.
     *
     * @test
     */
    public function exceptionCanBeCreatedFromResponse()
    {
        $data = ['value' => uniqid()];
        $jsonData = json_encode($data);
        $statusCode = random_int(200, 500);

        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($jsonData);
        $response->getStatusCode()->willReturn($statusCode);

        $exception = InvalidResponse::fromResponse($response->reveal());

        $this->assertStringContainsString($jsonData, $exception->getMessage());
        $this->assertStringContainsString((string) $statusCode, $exception->getMessage());
        $this->assertEquals($data, $exception->getData());
    }
}
