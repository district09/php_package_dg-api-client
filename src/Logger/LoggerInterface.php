<?php

namespace DigipolisGent\API\Logger;

/**
 * Interface LoggerInterface.
 *
 * @package DigipolisGent\API\Logger
 */
interface LoggerInterface
{
    /**
     * Log a log item.
     *
     * @param LogInterface $log
     *   The log item to log.
     */
    public function log(LogInterface $log);
}
