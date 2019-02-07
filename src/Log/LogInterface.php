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

    /**
     * Return the current element
     *
     * @return EntryInterface
     */
    public function current();

    /**
     * Offset to set
     *
     * @param $offset
     * @param EntryInterface $value
     */
    public function offsetSet($offset, $value);

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return EntryInterface
     */
    public function offsetGet($offset);
}