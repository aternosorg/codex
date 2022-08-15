<?php

namespace Aternos\Codex\Log\File;

/**
 * Class LogFile
 *
 * @package Aternos\Codex\Log\File
 */
abstract class LogFile implements LogFileInterface
{
    protected ?string $content = null;

    /**
     * Get the log file content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}