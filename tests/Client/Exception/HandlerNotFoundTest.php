<?php

declare(strict_types=1);

namespace DigipolisGent\API\Tests\Client\Exception;

use DigipolisGent\API\Client\Exception\HandlerNotFound;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * @covers \DigipolisGent\API\Client\Exception\HandlerNotFound
 */
class HandlerNotFoundTest extends TestCase
{
    /**
     * Exception can be created from a given request.
     *
     * @test
     */
    public function exceptionCanBeCreatedFromRequest(): void
    {
        $request = $this->prophesize(RequestInterface::class)->reveal();
        $expectedMessage = sprintf(
            'No handler was registered for %s',
            get_class($request)
        );

        $exception = HandlerNotFound::fromRequest($request);
        $this->assertEquals($expectedMessage, $exception->getMessage());
    }
}
