<?php

namespace Aternos\Codex\Parser;

use Aternos\Codex\Log\LogInterface;

/**
 * Interface ParserInterface
 *
 * @package Aternos\Codex\Parser
 */
interface ParserInterface
{
    /**
     * Set the log content as a string
     *
     * @param string $string
     * @return $this
     */
    public function setString(string $string);

    /**
     * Set the log file as file resource e.g. created with fopen()
     *
     * @param resource $fileResource
     * @return $this
     */
    public function setFile($fileResource);

    /**
     * Parse a log from resource to Log object
     *
     * @return LogInterface
     */
    public function parse(): LogInterface;
}