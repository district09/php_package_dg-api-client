<?php

declare(strict_types=1);

namespace DigipolisGent\API\Tests\Client\Configuration;

use DigipolisGent\API\Client\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\API\Client\Configuration\Configuration
 */
class ConfigurationTest extends TestCase
{
    /**
     * Configuration can be created without options.
     *
     * @test
     */
    public function configurationCanBeCreatedWithoutOptions(): void
    {
        $uri = 'https://test-endpoint.gent';
        $configuration = new Configuration($uri);

        $this->assertEquals($uri, $configuration->getUri(), 'Uri is set.');

        $this->assertSame(
            '1',
            $configuration->getVersion(),
            'Default version is "1".'
        );
        $this->assertEquals(
            20,
            $configuration->getTimeout(),
            'Default timeout is 20s.'
        );
    }

    /**
     * Configuration can be created with options.
     *
     * @test
     */
    public function constructorWithOptions(): void
    {
        $options = [
            'version' => 2,
            'timeout' => 10,
            'foo' => 'bar',
        ];
        $configuration = new Configuration(
            'https://foo.com',
            $options
        );

        $this->assertSame(
            (string) $options['version'],
            $configuration->getVersion(),
            'Version is set to custom value.'
        );
        $this->assertSame(
            $options['timeout'],
            $configuration->getTimeout(),
            'Timeout is set to custom value.'
        );
    }
}
