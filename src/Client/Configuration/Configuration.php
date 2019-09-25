<?php

namespace DigipolisGent\API\Client\Configuration;

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
    protected $options = array(
        'version' => 1,
        'timeout' => 20,
    );

    /**
     * @inheritDoc
     */
    public function __construct($endpointUri, array $options = array())
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
    public function getUri()
    {
        return $this->endpointUri;
    }

    /**
     * @inheritDoc
     */
    public function getVersion()
    {
        return $this->options['version'];
    }

    /**
     * @inheritDoc
     */
    public function getTimeout()
    {
        return $this->options['timeout'];
    }
}
