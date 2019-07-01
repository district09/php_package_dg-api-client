<?php

namespace DigipolisGent\API\Client\Configuration;

/**
 * Interface ConfigurationInterface.
 *
 * @package DigipolisGent\API\Client\Configuration
 */
interface ConfigurationInterface
{
    /**
     * Get the endpoint URI.
     *
     * @return string
     */
    public function getUri();

    /**
     * Get the service version number to use.
     *
     * @return string
     */
    public function getVersion();

    /**
     * Get the timeout value.
     *
     * @return int
     */
    public function getTimeout();

    /**
     * Get the content type, used for request headers.
     *
     * @return string
     */
    public function getContentType();

    /**
     * Get the accept type, used for request headers.
     *
     * @return string
     */
    public function getAcceptType();
}
