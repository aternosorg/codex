<?php

namespace Aternos\Codex\Log\File;

/**
 * Class StringLogFile
 *
 * @package Aternos\Codex\Log\File
 */
class StringLogFile extends LogFile
{
    /**
     * StringLogFile constructor.
     *
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->content = $string;
    }
}