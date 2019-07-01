<?php

namespace DigipolisGent\API\Service\Exception;

class UnexpectedResponse extends ServiceException
{
    /**
     * Generates exception with certain message
     *
     * @param string $actual
     * @param string $expected
     * @return static
     */
    public static function fromClass($actual, $expected)
    {
        return new static(sprintf('Got instance of %s expected %s response', $actual, $expected));
    }
}
