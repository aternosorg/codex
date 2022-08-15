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
    protected array $lines = [];
    protected ?Level $level = null;
    protected ?int $time = null;
    protected int $iterator = 0;

    /**
     * Set all lines at once in an array replacing the current lines
     *
     * @param LineInterface[] $lines
     * @return $this
     */
    public function setLines(array $lines = []): static
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
    public function addLine(LineInterface $line): static
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
     * @param Level $level
     * @return $this
     */
    public function setLevel(Level $level): static
    {
        $this->level = $level;
        return $this;
    }

    /**
     * Get the log level of the entry
     *
     * @return null|Level
     */
    public function getLevel(): ?Level
    {
        return $this->level;
    }

    /**
     * Set the timestamp of the entry
     *
     * @param int $time
     * @return $this
     */
    public function setTime(int $time): static
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Get the timestamp of the entry
     *
     * @return int|null
     */
    public function getTime(): ?int
    {
        return $this->time;
    }

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
     * Whether an offset exists
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->lines[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return LineInterface
     */
    public function offsetGet(mixed $offset): LineInterface
    {
        return $this->lines[$offset];
    }

    /**
     * Offset to set
     *
     * @param mixed $offset
     * @param LineInterface $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->lines[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param mixed $offset
     */
    public function offsetUnset(mixed $offset): void
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