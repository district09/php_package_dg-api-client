<?php

declare(strict_types=1);

namespace DigipolisGent\API\Logger;

/**
 * Allows loggers to be added to an object.
 */
interface LoggableInterface
{
    /**
     * Add a logger to the client to log interactions and errors.
     *
     * @param LoggerInterface $logger
     */
    public function addLogger(LoggerInterface $logger): void;
}
