<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Client\Exception;

use DigipolisGent\API\Client\Exception\InvalidResponse;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(InvalidResponse::class)]
final class InvalidResponseTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Exception can be created from response.
     */
    #[Test]
    public function exceptionCanBeCreatedFromResponse(): void
    {
        $data = json_encode(['value' => uniqid('', true)], JSON_THROW_ON_ERROR);
        $statusCode = random_int(200, 500);

        $stream = $this->prophesize(StreamInterface::class);
        $stream->__toString()->willReturn($data);

        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());
        $response->getStatusCode()->willReturn($statusCode);

        $exception = InvalidResponse::fromResponse($response->reveal());

        $this->assertStringContainsString($data, $exception->getMessage());
        $this->assertStringContainsString((string) $statusCode, $exception->getMessage());
        $this->assertEquals($data, $exception->getBody());
    }
}
