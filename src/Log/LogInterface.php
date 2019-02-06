<?php

namespace Aternos\Codex\Log;

/**
 * Interface LogInterface
 *
 * @package Aternos\Codex\Log
 */
interface LogInterface extends \Iterator, \Countable, \ArrayAccess
{
    /**
     * Set all entries of the log at once replacing the current entries
     *
     * @param array $entries
     * @return $this
     */
    public function setEntries(array $entries = []);

    /**
     * Add an entry to the log
     *
     * @param EntryInterface $entry
     * @return $this
     */
    public function addEntry(EntryInterface $entry);

    /**
     * Get all entries of the log
     *
     * @return array
     */
    public function getEntries(): array;

    /**
     * @return string
     */
    public function __toString();
}