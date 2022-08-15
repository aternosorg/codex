<?php

namespace Aternos\Codex\Printer;

use Aternos\Codex\Log\EntryInterface;
use Aternos\Codex\Log\LineInterface;
use Aternos\Codex\Log\LogInterface;

/**
 * Class Printer
 *
 * @package Aternos\Codex\Printer
 */
abstract class Printer implements PrinterInterface
{
    protected ?LogInterface $log = null;
    protected ?EntryInterface $entry = null;

    /**
     * Set the log
     *
     * @param LogInterface $log
     * @return $this
     */
    public function setLog(LogInterface $log): static
    {
        $this->log = $log;
        return $this;
    }

    /**
     * Set the entry
     *
     * @param EntryInterface $entry
     * @return $this
     */
    public function setEntry(EntryInterface $entry): static
    {
        $this->entry = $entry;
        return $this;
    }

    /**
     * Print the log
     *
     * @return string
     */
    public function print(): string
    {
        if ($this->entry) {
            return $this->printEntry();
        } else {
            return $this->printLog();
        }
    }

    /**
     * Print a log
     *
     * @return string
     */
    protected function printLog(): string
    {
        $return = "";
        foreach ($this->log as $entry) {
            $return .= $this->printEntry($entry);
        }

        return $return;
    }

    /**
     * Print an entry
     *
     * @param EntryInterface|null $entry
     * @return string
     */
    protected function printEntry(?EntryInterface $entry = null): string
    {
        if ($entry === null) {
            $entry = $this->entry;
        }

        $return = "";
        foreach ($entry as $line) {
            $return .= $this->printLine($line);
        }

        return $return;
    }

    /**
     * Print a line
     *
     * @param LineInterface $line
     * @return string
     */
    abstract protected function printLine(LineInterface $line): string;
}