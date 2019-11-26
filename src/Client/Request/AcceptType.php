<?php

declare(strict_types=1);

namespace DigipolisGent\API\Client\Request;

/**
 * The different Accept types.
 */
class AcceptType
{
    /**
     * HTML format.
     *
     * @var string
     */
    const HTML = 'text/html';

    /**
     * JSON format.
     *
     * @var string
     */
    const JSON = 'application/json';

    /**
     * TEXT format.
     *
     * @var string
     */
    const TEXT = 'text/plain';

    /**
     * XML format.
     *
     * @var string
     */
    const XML = 'application/xml';
}
