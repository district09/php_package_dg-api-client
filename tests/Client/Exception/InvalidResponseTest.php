<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Client\Exception;

use DigipolisGent\API\Client\Exception\InvalidResponse;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\API\Client\Exception\InvalidResponse
 */
class InvalidResponseTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Exception can be created from response.
     *
     * @test
     */
    public function exceptionCanBeCreatedFromResponse(): void
    {
        $data = json_encode(['value' => uniqid('', true)], JSON_THROW_ON_ERROR);
        $statusCode = random_int(200, 500);

        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($data);
        $response->getStatusCode()->willReturn($statusCode);

        $exception = InvalidResponse::fromResponse($response->reveal());

        $this->assertStringContainsString($data, $exception->getMessage());
        $this->assertStringContainsString((string) $statusCode, $exception->getMessage());
        $this->assertEquals($data, $exception->getBody());
    }
}
