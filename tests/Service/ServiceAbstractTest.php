<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Service\ServiceAbstract;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

#[CoversClass(ServiceAbstract::class)]
final class ServiceAbstractTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Service can be created with client.
     */
    #[Test]
    public function serviceCanBeCreatedFromClient(): void
    {
        $client = $this->prophesize(ClientInterface::class)->reveal();
        $service = new TestService($client);

        $this->assertSame($client, $service->getClient());
    }
}
