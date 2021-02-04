<?php

declare(strict_types=1);

namespace Gent\Tests\API\Service;

use DigipolisGent\API\Client\ClientInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @covers \DigipolisGent\API\Service\ServiceAbstract
 */
class ServiceAbstractTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Service can be created with client.
     *
     * @test
     */
    public function serviceCanBeCreatedFromClient(): void
    {
        $client = $this->prophesize(ClientInterface::class)->reveal();
        $service = new TestService($client);

        $this->assertSame($client, $service->getClient());
    }
}
