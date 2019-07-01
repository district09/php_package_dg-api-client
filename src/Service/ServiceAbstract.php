<?php

namespace DigipolisGent\API\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Logger\LoggableInterface;
use DigipolisGent\API\Logger\LoggableTrait;

/**
 * Class ServiceAbstract.
 *
 * @package DigipolisGent\API\Service
 */
abstract class ServiceAbstract implements ServiceInterface, LoggableInterface
{
    use LoggableTrait;

    /**
     * @var ClientInterface
     */
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
