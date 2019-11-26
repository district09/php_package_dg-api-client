<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Request;

/**
 * The different Method types.
 */
class MethodType
{
    /**
     * GET sending method.
     *
     * @var string
     */
    const GET = 'GET';

    /**
     * POST sending method.
     *
     * @var string
     */
    const POST = 'POST';

    /**
     * PUT sending method.
     *
     * @var string
     */
    const PUT = 'PUT';

    /**
     * DELETE sending method.
     *
     * @var string
     */
    const DELETE  = 'DELETE';
}
