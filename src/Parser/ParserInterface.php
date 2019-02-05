<?php

namespace Aternos\Codex\Parser;

use Aternos\Codex\Log\Log;

/**
 * Interface ParserInterface
 *
 * @package Aternos\Codex\Parser
 */
interface ParserInterface
{
    /**
     * ParserInterface constructor.
     *
     * $fileResource must be a resource
     * e.g. created with fopen()
     *
     * @param resource $fileResource
     */
    public function __construct($fileResource);

    /**
     * Parse a log from resource to Log object
     *
     * @return Log
     */
    public function parse(): Log;
}