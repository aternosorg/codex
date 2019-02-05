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
     * @return static
     */
    public function setLines(array $lines = []);

    /**
     * Add a line
     *
     * @param LineInterface $line
     * @return static
     */
    public function addLine(LineInterface $line);

    /**
     * Get all lines
     *
     * @return array
     */
    public function getLines(): array;

    /**
     * Set the log level of the entry
     *
     * @param $level
     * @return static
     */
    public function setLevel($level);

    /**
     * Get the log level of the entry
     *
     * @return mixed
     */
    public function getLevel();

    /**
     * @return string
     */
    public function __toString();
}