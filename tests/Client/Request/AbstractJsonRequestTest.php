<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Client\Request;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use DigipolisGent\API\Client\Request\AcceptType;
use DigipolisGent\API\Client\Request\MethodType;
use DigipolisGent\API\Client\Uri\UriInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(\DigipolisGent\API\Client\Request\AbstractJsonRequest::class)]
class AbstractJsonRequestTest extends TestCase
{
    #[Test]
    public function requestHasProperMethodAndHeaders(): void
    {
        $uri = $this->createMock(UriInterface::class);
        $uri->method('getUri')->willReturn('/test');

        $request = new class ($uri) extends AbstractJsonRequest {
        };

        $this->assertSame(MethodType::GET, $request->getMethod());
        $this->assertSame([AcceptType::JSON], $request->getHeader('Accept'));
    }
}
