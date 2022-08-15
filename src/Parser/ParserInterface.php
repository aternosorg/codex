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
     * Set the output log object
     *
     * @param LogInterface $log
     * @return $this
     */
    public function setLog(LogInterface $log): static;

    /**
     * Parse a log from resource to Log object
     */
    public function parse(): void;
}