<?php

declare(strict_types=1);

namespace DigipolisGent\API\Service\Exception;

/**
 * Exception when the response object was not of the correct type.
 */
final class UnexpectedResponse extends ServiceException
{
    /**
     * Generates exception with certain message
     *
     * @param string $actual
     *   The actual class name.
     * @param string $expected
     *   The expected class name.
     *
     * @return \DigipolisGent\API\Service\Exception\UnexpectedResponse
     */
    public static function fromClass(string $actual, string $expected): UnexpectedResponse
    {
        $message = sprintf(
            'Got instance of %s expected %s response',
            $actual,
            $expected
        );

        return new self($message, 500);
    }
}
