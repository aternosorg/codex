<?php

namespace Aternos\Codex\Printer;

use Aternos\Codex\Log\LogInterface;

/**
 * Interface PrinterInterface
 *
 * @package Aternos\Codex\Printer
 */
interface PrinterInterface
{
    /**
     * Set the log
     *
     * @param LogInterface $log
     * @return $this
     */
    public function setLog(LogInterface $log);

    /**
     * Print the log
     *
     * @return string
     */
    public function print(): string;
}