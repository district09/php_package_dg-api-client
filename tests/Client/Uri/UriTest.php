<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\API\Client\Uri;

use DigipolisGent\API\Client\Uri\Uri;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class UriTest extends TestCase
{
    /**
     * URI can be created from its URI path.
     */
    #[Test]
    public function uriCanBeCreatedFromItsPath(): void
    {
        $uri = new Uri('/test');

        $this->assertEquals('/test', $uri->getUri());
    }
}
