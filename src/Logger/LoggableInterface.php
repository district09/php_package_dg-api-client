<?php

namespace DigipolisGent\API\Logger;

/**
 * Interface LoggableInterface.
 *
 * @package DigipolisGent\API\Logger
 */
interface LoggableInterface
{
    /**
     * Add a logger to the client to log interactions and errors.
     *
     * @param LoggerInterface $logger
     */
    public function addLogger(LoggerInterface $logger);
}
