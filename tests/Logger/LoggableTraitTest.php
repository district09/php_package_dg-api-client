<?php

declare(strict_types=1);

namespace DigipolisGent\API\Tests\Logger;

use DigipolisGent\API\Logger\LoggableTrait;
use DigipolisGent\API\Logger\LoggerInterface;
use DigipolisGent\API\Logger\LogInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @covers \DigipolisGent\API\Logger\LoggableTrait
 */
class LoggableTraitTest extends TestCase
{
    use ProphecyTrait;
    use LoggableTrait;

    /**
     * Log item is passed to the loggers.
     *
     * @test
     */
    public function logItemIsPassedToLoggers(): void
    {
        $logItem = $this->prophesize(LogInterface::class)->reveal();
        $logger = $this->prophesize(LoggerInterface::class);
        $logger->log($logItem)->shouldBeCalled();

        $this->addLogger($logger->reveal());
        $this->log($logItem);
    }
}
