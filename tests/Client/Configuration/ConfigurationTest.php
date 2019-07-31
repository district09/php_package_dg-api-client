<?php

namespace DigipolisGent\API\Tests\Client\Configuration;

use DigipolisGent\API\Client\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{

    /**
     * Test constructor without options.
     */
    public function testConstructorWithoutOptions()
    {
        $uri = 'https://test-endpoint.gent';
        $configuration = new Configuration($uri);

        $this->assertEquals($uri, $configuration->getUri(), 'Uri is set.');

        // Default options.
        $this->assertEquals(
            1,
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
     * Test constructor with options.
     */
    public function testConstructorWithOptions()
    {
        $options = array(
            'version' => 2,
            'timeout' => 10,
            'foo' => 'bar',
        );
        $configuration = new Configuration(
            'https://foo.com',
            $options
        );

        // Custom options.
        $this->assertEquals(
            $options['version'],
            $configuration->getVersion(),
            'Version is set to custom value.'
        );
        $this->assertEquals(
            $options['timeout'],
            $configuration->getTimeout(),
            'Timeout is set to custom value.'
        );
    }
}
