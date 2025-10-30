<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Client\Request;

use DigipolisGent\API\Client\Request\AbstractHtmlRequest;
use DigipolisGent\API\Client\Request\AcceptType;
use DigipolisGent\API\Client\Request\MethodType;
use DigipolisGent\API\Client\Uri\UriInterface;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(AbstractHtmlRequest::class)]
class AbstractHtmlRequestTest extends TestCase
{
    /**
     * Request has default method and accept header.
     */
    #[Test]
    public function requestHasProperMethodAndHeaders(): void
    {
        $uri = $this->createMock(UriInterface::class);
        $uri->method('getUri')->willReturn('/test');

        $request = new class ($uri) extends AbstractHtmlRequest {
        };

        $this->assertSame(MethodType::GET, $request->getMethod());
        $this->assertSame([AcceptType::HTML], $request->getHeader('Accept'));
    }
}
