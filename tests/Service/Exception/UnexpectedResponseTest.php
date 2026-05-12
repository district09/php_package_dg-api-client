<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Service\Exception;

use DigipolisGent\API\Service\Exception\UnexpectedResponse;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(UnexpectedResponse::class)]
final class UnexpectedResponseTest extends TestCase
{
    /**
     * Exception can be created from the actual and expected class name.
     */
    #[Test]
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
