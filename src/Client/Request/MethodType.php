<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Request;

/**
 * The different Method types.
 */
final class MethodType
{
    /**
     * GET sending method.
     *
     * @var string
     */
    public const GET = 'GET';

    /**
     * POST sending method.
     *
     * @var string
     */
    public const POST = 'POST';

    /**
     * PUT sending method.
     *
     * @var string
     */
    public const PUT = 'PUT';

    /**
     * DELETE sending method.
     *
     * @var string
     */
    public const DELETE  = 'DELETE';
}
