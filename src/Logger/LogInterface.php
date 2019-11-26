<?php

declare(strict_types=1);

namespace DigipolisGent\API\Logger;

/**
 * Log item interface.
 */
interface LogInterface
{
    /**
     * Cast the log item to a string.
     *
     * @return string
     */
    public function __toString(): string;
}
