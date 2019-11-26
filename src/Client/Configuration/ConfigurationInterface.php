<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Configuration;

/**
 * Configuration used to create the client.
 */
interface ConfigurationInterface
{
    /**
     * Get the endpoint URI.
     *
     * @return string
     */
    public function getUri(): string;

    /**
     * Get the service version number to use.
     *
     * @return string
     */
    public function getVersion(): string;

    /**
     * Get the timeout value.
     *
     * @return int
     */
    public function getTimeout(): int;
}
