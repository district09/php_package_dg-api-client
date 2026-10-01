<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Configuration;

/**
 * Configuration for authentication using API key headers.
 */
interface ApiKeyConfigurationInterface extends ClientConfigurationInterface
{
    /**
     * Get the API key.
     *
     * @return string
     */
    public function getApiKey(): string;

    /**
     * Get the application ID.
     *
     * @return string
     */
    public function getApplicationId(): string;
}
