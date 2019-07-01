<?php

namespace DigipolisGent\API\Service;

use DigipolisGent\API\Client\ClientInterface;

/**
 * Interface ServiceInterface.
 *
 * @package DigipolisGent\API\Service
 */
interface ServiceInterface
{
    /**
     * ServiceInterface constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client);
}
