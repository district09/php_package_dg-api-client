<?php

declare(strict_types=1);

namespace DigipolisGent\API\Service;

use DigipolisGent\API\Cache\CacheableInterface;
use DigipolisGent\API\Cache\CacheableTrait;
use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Logger\LoggableInterface;
use DigipolisGent\API\Logger\LoggableTrait;

/**
 * Abstract service containing the client to access the backend.
 */
abstract class ServiceAbstract implements ServiceInterface, LoggableInterface, CacheableInterface
{
    use LoggableTrait;
    use CacheableTrait;

    /**
     * @var \DigipolisGent\API\Client\ClientInterface
     */
    private $client;

    /**
     * @param \DigipolisGent\API\Client\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Get the client.
     *
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    protected function client(): ClientInterface
    {
        return $this->client;
    }
}
