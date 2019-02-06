<?php

namespace Aternos\Codex\Parser;

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
    protected $fileResource = null;

    /**
     * @var string
     */
    protected $string = null;

    /**
     * Set the log content as a string
     *
     * @param string $string
     * @return $this
     */
    public function setString(string $string)
    {
        $this->string = $string;
        return $this;
    }

    /**
     * Set the log file as file resource e.g. created with fopen()
     *
     * @param resource $fileResource
     * @return $this
     */
    public function setFile($fileResource)
    {
        $this->fileResource = $fileResource;
        return $this;
    }

    /**
     * Get the log content as string, either directly from string or from file
     *
     * @return string
     */
    protected function getContent(): string
    {
        if ($this->string !== null) {
            return $this->string;
        }

        if ($this->fileResource !== null) {
            if ($this->fileResource === false) {
                throw new \InvalidArgumentException("File resource must not be false.");
            }

            $contents = '';
            while (!feof($this->fileResource)) {
                $contents .= fread($this->fileResource, 8192);
            }
            fclose($this->fileResource);

            return $contents;
        }

        throw new \InvalidArgumentException("A string or a file resource has to be set before calling this function.");
    }
}