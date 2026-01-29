<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Configuration;

/**
 * Configuration used to create the client.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Endpoint URI for the service.
     *
     * @var string
     */
    protected string $endpointUri;

    /**
     * Endpoint URI for the authentication.
     *
     * @var string
     */
    protected string $authEndpointUri;

    /**
     * Client ID.
     *
     * @var string
     */
    protected string $clientId;

    /**
     * Client secret.
     *
     * @var string
     */
    protected string $clientSecret;

    /**
     * Auth scope.
     *
     * @var string
     */
    protected string $scope;

    /**
     * The configuration options.
     *
     * @var array
     */
    protected array $options = [
        'version' => 1,
        'timeout' => 20,
    ];

    /**
     * Create new configuration.
     *
     * @param string $endpointUri
     *   The endpoint URI.
     * @param string $authEndpointUri
     *   The authentication endpoint URI.
     * @param string $clientId
     *   The client ID.
     * @param string $clientSecret
     *   The client secret.
     * @param string $scope
     *   The authentication scope.
     * @param array $options
     *   The client extra options.
     */
    public function __construct(
        string $endpointUri,
        string $authEndpointUri,
        string $clientId,
        string $clientSecret,
        string $scope,
        array $options = [],
    ) {
        $this->endpointUri = $endpointUri;
        $this->authEndpointUri = $authEndpointUri;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->scope = $scope;

        foreach ($options as $key => $value) {
            if (!array_key_exists($key, $this->options)) {
                continue;
            }

            $this->options[$key] = $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function getUri(): string
    {
        return $this->endpointUri;
    }

    /**
     * @inheritDoc
     */
    public function getAuthUri(): string
    {
        return $this->authEndpointUri;
    }

    /**
     * @inheritDoc
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @inheritDoc
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @inheritDoc
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @inheritDoc
     */
    public function getVersion(): string
    {
        return (string) $this->options['version'];
    }

    /**
     * @inheritDoc
     */
    public function getTimeout(): int
    {
        return $this->options['timeout'];
    }
}
