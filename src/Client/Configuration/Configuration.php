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
    protected $endpointUri;

    /**
     * The configuration options.
     *
     * @var array
     */
    protected $options = [
        'version' => 1,
        'timeout' => 20,
    ];

    /**
     * @inheritDoc
     */
    public function __construct($endpointUri, array $options = [])
    {
        $this->endpointUri = $endpointUri;

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
