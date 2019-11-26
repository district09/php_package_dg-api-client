<?php

declare(strict_types=1);

namespace DigipolisGent\API\Tests\Service\Exception;

use DigipolisGent\API\Service\Exception\UnexpectedResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\API\Service\Exception\UnexpectedResponse
 */
class UnexpectedResponseTest extends TestCase
{
    /**
     * Exception can be created from the actual and expected class name.
     *
     * @test
     */
    public function exceptionCanBeCreatedFromClassNames(): void
    {
        $exception = UnexpectedResponse::fromClass('Actual', 'Expected');
        $this->assertEquals(
            'Got instance of Actual expected Expected response',
            $exception->getMessage()
        );
        $this->assertSame(500, $exception->getCode());
    }
}
