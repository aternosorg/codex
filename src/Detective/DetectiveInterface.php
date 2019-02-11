<?php

namespace Aternos\Codex\Detective;

use Aternos\Codex\Log\File\LogFileInterface;
use Aternos\Codex\Log\LogInterface;

/**
 * Interface DetectiveInterface
 *
 * @package Aternos\Codex\Detective
 */
interface DetectiveInterface
{
    /**
     * Set possible log classes
     *
     * Every class must implement DetectableLogInterface
     *
     * @param array $logClasses
     * @return $this
     */
    public function setPossibleLogClasses(array $logClasses);

    /**
     * Add a possible insight class
     *
     * The class must implement DetectableLogInterface
     *
     * @param string $logClass
     * @return $this
     */
    public function addPossibleLogClass(string $logClass);

    /**
     * Set the log file
     *
     * @param LogFileInterface $logFile
     * @return mixed
     */
    public function setLogFile(LogFileInterface $logFile);

    /**
     * Detect a log type out of possible classes by using detector
     *
     * @return LogInterface
     */
    public function detect();
}