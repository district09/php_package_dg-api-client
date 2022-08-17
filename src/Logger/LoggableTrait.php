<?php

declare(strict_types=1);

namespace DigipolisGent\API\Logger;

/**
 * Use this trait to add loggers to an object.
 */
trait LoggableTrait
{
    /**
     * Array of loggers.
     *
     * @var \DigipolisGent\API\Logger\LoggerInterface[]
     */
    protected array $loggers = [];

    /**
     * Add a logger to an object.
     *
     * @param \DigipolisGent\API\Logger\LoggerInterface $logger
     */
    public function addLogger(LoggerInterface $logger): void
    {
        $this->loggers[] = $logger;
    }

    /**
     * Pass a log item to the loggers.
     *
     * @param LogInterface $log
     */
    protected function log(LogInterface $log): void
    {
        foreach ($this->loggers as $logger) {
            $logger->log($log);
        }
    }
}
