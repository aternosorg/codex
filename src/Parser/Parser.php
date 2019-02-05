<?php

namespace Aternos\Codex\Parser;

use Aternos\Codex\Log\Log;

/**
 * Class Parser
 *
 * @package Aternos\Codex\Parser
 */
abstract class Parser implements ParserInterface
{
    /**
     * @var resource
     */
    protected $fileResource;

    /**
     * Parser constructor.
     *
     * $fileResource must be a resource
     * e.g. created with fopen()
     *
     * @param resource $fileResource
     */
    public function __construct($fileResource)
    {
        $this->fileResource = $fileResource;
    }

    /**
     * Parse a log from resource to Log object
     *
     * @return Log
     */
    public function parse(): Log
    {

    }
}