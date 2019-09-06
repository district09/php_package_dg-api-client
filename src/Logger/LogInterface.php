<?php

namespace DigipolisGent\API\Logger;

/**
 * Interface LogInterface.
 *
 * @package DigipolisGent\API\Logger
 */
interface LogInterface
{
    /**
     * A log should be able to be converted to a string
     *
     * @return string
     */
    public function __toString();
}
