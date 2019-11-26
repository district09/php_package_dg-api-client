<?php

declare(strict_types=1);

namespace DigipolisGent\API\Logger;

/**
 * Logger interface.
 */
interface LoggerInterface
{
    /**
     * Log a log item.
     *
     * @param LogInterface $log
     *   The log item to log.
     */
    public function log(LogInterface $log): void;
}
