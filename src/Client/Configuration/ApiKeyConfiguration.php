<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Configuration;

/**
 * Configuration for authentication using API key headers.
 */
class ApiKeyConfiguration extends LegacyConfiguration implements ApiKeyConfigurationInterface
{
    /**
     * The API key.
     *
     * @var string
     */
    protected string $apiKey;

    /**
     * The application ID.
     *
     * @var string
     */
    protected string $applicationId;

    /**
     * Create configuration using the apiKey and applicationId headers.
     *
     * @param string $endpointUri
     *   The endpoint URI.
     * @param string $apiKey
     *   The API key.
     * @param string $applicationId
     *   The application ID.
     * @param array $options
     *   The client extra options.
     */
    public function __construct(string $endpointUri, string $apiKey, string $applicationId, array $options = [])
    {
        parent::__construct($endpointUri, $options);
        $this->apiKey = $apiKey;
        $this->applicationId = $applicationId;
    }

    /**
     * @inheritDoc
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @inheritDoc
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }
}
