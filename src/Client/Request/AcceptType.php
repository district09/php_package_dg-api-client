<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Request;

/**
 * The different Accept types.
 */
final class AcceptType
{
    /**
     * HTML format.
     *
     * @var string
     */
    public const HTML = 'text/html';

    /**
     * JSON format.
     *
     * @var string
     */
    public const JSON = 'application/json';

    /**
     * TEXT format.
     *
     * @var string
     */
    public const TEXT = 'text/plain';

    /**
     * XML format.
     *
     * @var string
     */
    public const XML = 'application/xml';
}
