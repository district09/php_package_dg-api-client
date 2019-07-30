<?php

namespace DigipolisGent\API\Service;

use DigipolisGent\API\Cache\CacheableInterface;
use DigipolisGent\API\Cache\CacheableTrait;
use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Logger\LoggableInterface;
use DigipolisGent\API\Logger\LoggableTrait;

/**
 * Class ServiceAbstract.
 *
 * @package DigipolisGent\API\Service
 */
abstract class ServiceAbstract implements ServiceInterface, LoggableInterface, CacheableInterface
{
    use LoggableTrait;
    use CacheableTrait;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @param ClientInterface $client
     *
     * @codeCoverageIgnore
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
