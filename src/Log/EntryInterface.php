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
     * @param array $lines
     * @return $this
     */
    public function setLines(array $lines = []);

    /**
     * Add a line
     *
     * @param LineInterface $line
     * @return $this
     */
    public function addLine(LineInterface $line);

    /**
     * Get all lines
     *
     * @return array
     */
    public function getLines(): array;

    /**
     * @return string
     */
    public function __toString();

    /**
     * Return the current element
     *
     * @return LineInterface
     */
    public function current();

    /**
     * Offset to set
     *
     * @param $offset
     * @param LineInterface $value
     */
    public function offsetSet($offset, $value);

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return LineInterface
     */
    public function offsetGet($offset);
}