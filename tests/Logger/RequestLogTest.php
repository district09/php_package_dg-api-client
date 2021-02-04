<?php

declare(strict_types=1);

namespace DigipolisGent\API\Tests\Logger;

use DigipolisGent\API\Logger\RequestLog;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\RequestInterface;

/**
 * @covers \DigipolisGent\API\Logger\RequestLog
 */
class RequestLogTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Cast to string contains all request details.
     *
     * @test
     */
    public function castToStringHasAllDetails(): void
    {
        $request = $this->prophesize(RequestInterface::class);
        $request->getMethod()->willReturn('GET');
        $request->getHeaders()->willReturn(['test' => 'foo']);
        $request->getUri()->willReturn('/uriTest');
        $request->getBody()->willReturn('bodyTest');

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
