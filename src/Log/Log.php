<?php

namespace Aternos\Codex\Log;

/**
 * Class Log
 *
 * @package Aternos\Codex\Log
 */
class Log implements LogInterface
{
    /**
     * @var array
     */
    protected $entries;

    /**
     * @var int
     */
    protected $iterator = 0;

    /**
     * Set all entries of the log at once replacing the current entries
     *
     * @param array $entries
     * @return $this
     */
    public function setEntries(array $entries = [])
    {
        $this->entries = $entries;
        return $this;
    }

    /**
     * Add an entry to the log
     *
     * @param EntryInterface $entry
     * @return $this
     */
    public function addEntry(EntryInterface $entry)
    {
        $this->entries[] = $entry;
        return $this;
    }

    /**
     * Get all entries of the log
     *
     * @return array
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * Return the current element
     *
     * @return Entry
     */
    public function current()
    {
        return $this->entries[$this->iterator];
    }

    /**
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
        $this->iterator++;
    }

    /**
     * Return the key of the current element
     *
     * @return int
     */
    public function key()
    {
        return $this->iterator;
    }

    /**
     * Checks if current position is valid
     *
     * @return boolean
     */
    public function valid()
    {
        return array_key_exists($this->iterator, $this->entries);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind()
    {
        $this->iterator = 0;
    }

    /**
     * Count elements of an object
     *
     * @return int
     */
    public function count()
    {
        return count($this->entries);
    }

    /**
     * Whether a offset exists
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->result[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->entries[$offset];
    }

    /**
     * Offset to set
     *
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        $this->entries[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->entries[$offset]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode("\n", $this->getEntries());
    }
}