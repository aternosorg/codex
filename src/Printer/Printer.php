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
    /**
     * @var LogInterface
     */
    protected $log;

    /**
     * @var EntryInterface
     */
    protected $entry;

    /**
     * Set the log
     *
     * @param LogInterface $log
     * @return $this
     */
    public function setLog(LogInterface $log)
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
    public function setEntry(EntryInterface $entry)
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
            return $this->printEntry($this->entry);
        } else {
            return $this->printLog($this->log);
        }
    }

    /**
     * Print a log
     *
     * @param LogInterface $log
     * @return string
     */
    protected function printLog(LogInterface $log)
    {
        $return = "";
        foreach ($log as $entry) {
            $return .= $this->printEntry($entry);
        }

        return $return;
    }

    /**
     * Print an entry
     *
     * @param EntryInterface $entry
     * @return string
     */
    protected function printEntry(EntryInterface $entry)
    {
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
    abstract protected function printLine(LineInterface $line);
}