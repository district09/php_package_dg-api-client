<?php

namespace DigipolisGent\API\Tests\Logger;

use DigipolisGent\API\Logger\LoggableTrait;
use DigipolisGent\API\Logger\LoggerInterface;
use DigipolisGent\API\Logger\LogInterface;
use PHPUnit\Framework\TestCase;

class LoggableTraitTest extends TestCase
{

    use LoggableTrait;

    /**
     * @var LogInterface
     */
    protected $log;

    protected function setUp()
    {
        parent::setUp();
        $this->log = $this->getMockBuilder(LogInterface::class)->getMock();
        for ($i = 0; $i <= random_int(2, 5); $i++) {
            $logger = $this->getMockBuilder(LoggerInterface::class)->getMock();
            $logger->expects($this->atLeastOnce())->method('log')->with($this->log);
            $this->addLogger($logger);
        }
    }

    public function testLog()
    {
        $this->assertNull($this->log($this->log));
    }
}
