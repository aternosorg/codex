<?php

namespace Aternos\Codex\Log;

/**
 * Interface EntryInterface
 *
 * @package Aternos\Codex\Log
 */
interface EntryInterface extends \Iterator, \Countable, \ArrayAccess
{
    /**
     * Set all lines at once in an array replacing the current lines
     *
     * @param LineInterface[] $lines
     * @return $this
     */
    public function setLines(array $lines = []): static;

    /**
     * Add a line
     *
     * @param LineInterface $line
     * @return $this
     */
    public function addLine(LineInterface $line): static;

    /**
     * Get all lines
     *
     * @return LineInterface[]
     */
    public function getLines(): array;

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * Return the current element
     *
     * @return LineInterface
     */
    public function current(): LineInterface;

    /**
     * Offset to set
     *
     * @param mixed $offset
     * @param LineInterface $value
     */
    public function offsetSet(mixed $offset, mixed $value): void;

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return LineInterface
     */
    public function offsetGet(mixed $offset): LineInterface;
}