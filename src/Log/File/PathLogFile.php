<?php

namespace Aternos\Codex\Log\File;

/**
 * Class PathLogFile
 *
 * @package Aternos\Codex\Log\File
 */
class PathLogFile extends LogFile
{
    /**
     * PathLogFile constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException("File '" . $path . "' not found.");
        }

        $this->content = file_get_contents($path);
    }
}