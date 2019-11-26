<?php

declare(strict_types=1);

namespace Gent\Tests\API\Client\Request;

use DigipolisGent\API\Client\Request\AbstractXmlRequest;
use DigipolisGent\API\Client\Request\AcceptType;
use DigipolisGent\API\Client\Request\MethodType;
use DigipolisGent\API\Client\Uri\Uri;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\API\Client\Request\AbstractXmlRequest
 */
class AbstractXmlRequestTest extends TestCase
{
    /**
     * Request has default method and accept header.
     *
     * @test
     */
    public function requestHasProperMethodAndHeaders(): void
    {
        $request = $this->getMockForAbstractClass(
            AbstractXmlRequest::class,
            [new Uri('/test')]
        );

        $this->assertEquals(MethodType::GET, $request->getMethod());
        $this->assertEquals([AcceptType::XML], $request->getHeader('Accept'));
    }
}
