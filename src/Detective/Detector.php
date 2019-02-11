<?php

namespace Aternos\Codex\Detective;

use Aternos\Codex\Log\File\LogFileInterface;

/**
 * Class Detector
 *
 * @package Aternos\Codex\Detective
 */
abstract class Detector implements DetectorInterface
{
    /**
     * @var LogFileInterface
     */
    protected $logFile;

    /**
     * Set the log file
     *
     * @param LogFileInterface $logFile
     * @return $this
     */
    public function setLogFile(LogFileInterface $logFile)
    {
        $this->logFile = $logFile;
        return $this;
    }

    /**
     * Get the log content as string
     *
     * @return string
     */
    protected function getLogContent(): string
    {
        return $this->logFile->getContent();
    }

    /**
     * Get the log content as array split by line
     *
     * @return array
     */
    protected function getLogContentAsArray(): array
    {
        return explode(PHP_EOL, $this->getLogContent());
    }
}