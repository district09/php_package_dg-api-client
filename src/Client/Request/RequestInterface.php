<?php

namespace DigipolisGent\API\Client\Request;

/**
 * Interface RequestInterface.
 *
 * @package DigipolisGent\API\Client\Request
 */
interface RequestInterface extends \Psr\Http\Message\RequestInterface
{
    /**
     * GET sending method.
     *
     * @var string
     */
    const METHOD_GET = 'GET';

    /**
     * POST sending method.
     *
     * @var string
     */
    const METHOD_POST = 'POST';

    /**
     * PUT sending method.
     *
     * @var string
     */
    const METHOD_PUT = 'PUT';

    /**
     * DELETE sending method.
     *
     * @var string
     */
    const METHOD_DELETE  = 'DELETE';
}
