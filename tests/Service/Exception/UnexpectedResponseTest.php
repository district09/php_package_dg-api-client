<?php

namespace DigipolisGent\API\Tests\Service\Exception;

use DigipolisGent\API\Service\Exception\UnexpectedResponse;
use PHPUnit\Framework\TestCase;

class UnexpectedResponseTest extends TestCase
{

    public function testFromClass()
    {
        $actual = uniqid();
        $expected = uniqid();
        $exception = UnexpectedResponse::fromClass($actual, $expected);
        // Message should contain both classnames.
        $this->assertContains($actual, $exception->getMessage());
        $this->assertContains($expected, $exception->getMessage());
    }
}
