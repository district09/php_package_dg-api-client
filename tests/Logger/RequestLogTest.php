<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Logger;

use DigipolisGent\API\Logger\RequestLog;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

#[CoversClass(RequestLog::class)]
final class RequestLogTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Cast to string contains all request details.
     */
    #[Test]
    public function castToStringHasAllDetails(): void
    {
        $stream = $this->prophesize(StreamInterface::class);
        $stream->__toString()->willReturn('bodyTest');

        $uri = $this->prophesize(UriInterface::class);
        $uri->__toString()->willReturn('/uriTest');

        $request = $this->prophesize(RequestInterface::class);
        $request->getMethod()->willReturn('GET');
        $request->getHeaders()->willReturn(['test' => 'foo']);
        $request->getUri()->willReturn($uri->reveal());
        $request->getBody()->willReturn($stream->reveal());

        $logItem = new RequestLog($request->reveal());

        $expected = <<<EOT
Request
 Method GET
 Headers {"test":"foo"}
 URI /uriTest
 Body "bodyTest"


EOT;
        $this->assertEquals($expected, (string) $logItem);
    }
}
