<?php

namespace Aternos\Codex\Log;

use Aternos\Codex\Log\File\LogFileInterface;
use Aternos\Codex\Parser\ParserInterface;

/**
 * Interface LogInterface
 *
 * @package Aternos\Codex\Log
 */
interface LogInterface extends \Iterator, \Countable, \ArrayAccess
{
    /**
     * Get the default parser
     *
     * @return ParserInterface
     */
    public static function getDefaultParser();

    /**
     * Set the log file
     *
     * @param LogFileInterface $logFile
     * @return $this
     */
    public function setLogFile(LogFileInterface $logFile);

    /**
     * Get the log file
     *
     * @return LogFileInterface
     */
    public function getLogFile(): LogFileInterface;

    /**
     * Parse a log file with a parser
     *
     * Every log type should have a default parser,
     * but the $parser argument can be used to override
     * the default parser
     *
     * @param ParserInterface|null $parser
     * @return $this
     */
    public function parse(ParserInterface $parser = null);

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