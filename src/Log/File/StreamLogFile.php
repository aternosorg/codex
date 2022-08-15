<?php

namespace Aternos\Codex\Log\File;

use InvalidArgumentException;

/**
 * Class StreamLogFile
 *
 * @package Aternos\Codex\Log\File
 */
class StreamLogFile extends LogFile
{
    /**
     * StreamLogFile constructor.
     *
     * @param resource $streamResource
     */
    public function __construct($streamResource)
    {
        if (!is_resource($streamResource)) {
            throw new InvalidArgumentException("Stream argument is not a resource");
        }
        
        $this->content = '';
        while (!feof($streamResource)) {
            $this->content .= fread($streamResource, 8192);
        }
    }
}