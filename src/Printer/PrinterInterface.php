<?php

namespace Aternos\Codex\Printer;

use Aternos\Codex\Log\EntryInterface;
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
    public function setLog(LogInterface $log): static;

    /**
     * Set the entry
     *
     * @param EntryInterface $entry
     * @return $this
     */
    public function setEntry(EntryInterface $entry): static;

    /**
     * Print the log
     *
     * @return string
     */
    public function print(): string;
}