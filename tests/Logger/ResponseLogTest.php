<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Logger;

use DigipolisGent\API\Logger\ResponseLog;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface;

#[CoversClass(ResponseLog::class)]
final class ResponseLogTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Cast to string contains all response details.
     */
    #[Test]
    public function castToStringHasAllDetails(): void
    {
        $response = $this->prophesize(ResponseInterface::class);
        $response->getStatusCode()->willReturn(400);
        $response->getHeaders()->willReturn(['test' => 'foo']);
        $response->getBody()->willReturn('bodyTest');

        $logItem = new ResponseLog($response->reveal());

        $expected = <<<EOT
Response
 Status 400
 Headers {"test":"foo"}
 Body "bodyTest"


EOT;
        $this->assertEquals($expected, (string) $logItem);
    }
}
