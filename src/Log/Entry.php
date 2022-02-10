<?php

namespace Aternos\Codex\Log;

/**
 * Class Entry
 *
 * @package Aternos\Codex\Log
 */
class Entry implements EntryInterface
{
    /**
     * @var LineInterface[]
     */
    protected $lines = [];

    /**
     * @var mixed
     */
    protected $level;

    /**
     * @var int
     */
    protected $time;

    /**
     * Set all lines at once in an array replacing the current lines
     *
     * @param LineInterface[] $lines
     * @return $this
     */
    public function setLines(array $lines = [])
    {
        $this->lines = $lines;
        return $this;
    }

    /**
     * Add a line
     *
     * @param LineInterface $line
     * @return $this
     */
    public function addLine(LineInterface $line)
    {
        $this->lines[] = $line;
        return $this;
    }

    /**
     * Get all lines
     *
     * @return array
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * Set the log level of the entry
     *
     * @param $level
     * @return $this
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * Get the log level of the entry
     *
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set the timestamp of the entry
     *
     * @param int $time
     * @return $this
     */
    public function setTime(int $time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Get the timestamp of the entry
     *
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @var int
     */
    protected $iterator = 0;

    /**
     * Return the current element
     *
     * @return Line
     */
    public function current(): Line
    {
        return $this->lines[$this->iterator];
    }

    /**
     * Move forward to next element
     *
     * @return void
     */
    public function next(): void
    {
        $this->iterator++;
    }

    /**
     * Return the key of the current element
     *
     * @return int
     */
    public function key(): int
    {
        return $this->iterator;
    }

    /**
     * Checks if current position is valid
     *
     * @return boolean
     */
    public function valid(): bool
    {
        return array_key_exists($this->iterator, $this->lines);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->iterator = 0;
    }

    /**
     * Count elements of an object
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->lines);
    }

    /**
     * Whether a offset exists
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->result[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return LineInterface
     */
    public function offsetGet($offset): LineInterface
    {
        return $this->lines[$offset];
    }

    /**
     * Offset to set
     *
     * @param $offset
     * @param LineInterface $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->lines[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->lines[$offset]);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode("\n", $this->getLines());
    }
}