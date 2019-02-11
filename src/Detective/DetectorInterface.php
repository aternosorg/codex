<?php

namespace Aternos\Codex\Detective;

use Aternos\Codex\Log\File\LogFileInterface;

/**
 * Interface DetectorInterface
 *
 * @package Aternos\Codex\Detective
 */
interface DetectorInterface
{
    /**
     * Set the log file
     *
     * @param LogFileInterface $logFile
     * @return $this
     */
    public function setLogFile(LogFileInterface $logFile);

    /**
     * Detect if the log matches
     *
     * Return true to directly force the detective to accept your result without considering any other detector
     * Return false to force the detective to never use your result
     * Return a number between 0 and 1 as probability for this detector
     * Possible algorithm to get this number would be (matching lines) / (total lines)
     *
     * The detective decides which detector wins (and which related log class to use) in this order:
     *     return === true
     *     highest return
     *     default log
     *
     * @return bool|int|float
     */
    public function detect();
}