<?php

declare(strict_types=1);

namespace DigipolisGent\API\Service;

use DigipolisGent\API\Client\ClientInterface;

/**
 * Interface for services.
 */
interface ServiceInterface
{
    /**
     * ServiceInterface constructor.
     *
     * @param \DigipolisGent\API\Client\ClientInterface $client
     */
    public function __construct(ClientInterface $client);
}
