<?php

namespace DigipolisGent\API\Logger;

/**
 * Class LoggableTrait.
 *
 * Use this trait to add loggers to an object.
 *
 * @package DigipolisGent\API\Logger
 */
trait LoggableTrait
{
    /**
     * Array of loggers.
     *
     * @var LoggerInterface[]
     */
    private $loggers = array();

    /**
     * Add a logger to an object.
     *
     * @param LoggerInterface $logger
     */
    public function addLogger(LoggerInterface $logger)
    {
        $this->loggers[] = $logger;
    }

    /**
     * Pass a log item to the loggers.
     *
     * @param LogInterface $log
     */
    protected function log(LogInterface $log)
    {
        foreach ($this->loggers as $logger) {
            $logger->log($log);
        }
    }
}
