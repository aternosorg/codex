<?php

namespace Aternos\Codex\Parser;

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
}