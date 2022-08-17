<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Service\ServiceAbstract;

/**
 * Test class to validate the ServiceAbstract.
 *
 * @codeCoverageIgnore
 */
class TestService extends ServiceAbstract
{
    /**
     * Method only for testing purposes.
     *
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client();
    }
}
