<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Logger;

use DigipolisGent\API\Logger\LoggableTrait;
use DigipolisGent\API\Logger\LoggerInterface;
use DigipolisGent\API\Logger\LogInterface;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

#[CoversTrait(LoggableTrait::class)]
final class LoggableTraitTest extends TestCase
{
    use ProphecyTrait;
    use LoggableTrait;

    /**
     * Log item is passed to the loggers.
     */
    #[Test]
    public function logItemIsPassedToLoggers(): void
    {
        $logItem = $this->prophesize(LogInterface::class)->reveal();
        $logger = $this->prophesize(LoggerInterface::class);
        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $logger->log($logItem)->shouldBeCalled();

        $this->addLogger($logger->reveal());
        $this->log($logItem);
    }
}
