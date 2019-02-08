<?php

namespace Aternos\Codex\Log\File;

/**
 * Interface LogFileInterface
 *
 * @package Aternos\Codex\Log\File
 */
interface LogFileInterface
{
    /**
     * Get the log file content
     *
     * @return string
     */
    public function getContent(): string;
}