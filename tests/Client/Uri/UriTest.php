<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Client\Uri;

use DigipolisGent\API\Client\Uri\Uri;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\API\Client\Uri\Uri
 */
class UriTest extends TestCase
{
    /**
     * URI can be created from its URI path.
     *
     * @test
     */
    public function uriCanBeCreatedFromItsPath(): void
    {
        $uri = new Uri('/test');

        $this->assertEquals('/test', $uri->getUri());
    }
}
