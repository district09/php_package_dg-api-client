<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Client\Request;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use DigipolisGent\API\Client\Request\AcceptType;
use DigipolisGent\API\Client\Request\MethodType;
use DigipolisGent\API\Client\Uri\Uri;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\API\Client\Request\AbstractJsonRequest
 */
class AbstractJsonRequestTest extends TestCase
{
    /**
     * Request has default method and accept header.
     *
     * @test
     */
    public function requestHasProperMethodAndHeaders(): void
    {
        $request = $this->getMockForAbstractClass(
            AbstractJsonRequest::class,
            [new Uri('/test')]
        );

        $this->assertEquals(MethodType::GET, $request->getMethod());
        $this->assertEquals([AcceptType::JSON], $request->getHeader('Accept'));
    }
}
