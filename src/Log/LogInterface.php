<?php

namespace Aternos\Codex\Log;

use ArrayAccess;
use Aternos\Codex\Log\File\LogFileInterface;
use Aternos\Codex\Parser\ParserInterface;
use Countable;
use Iterator;
use JsonSerializable;

/**
 * Interface LogInterface
 *
 * @package Aternos\Codex\Log
 */
interface LogInterface extends Iterator, Countable, ArrayAccess, JsonSerializable
{
    /**
     * Get the default parser
     *
     * @return ParserInterface
     */
    public static function getDefaultParser(): ParserInterface;

    /**
     * Set the log file
     *
     * @param LogFileInterface $logFile
     * @return $this
     */
    public function setLogFile(LogFileInterface $logFile): static;

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
    public function parse(?ParserInterface $parser = null): static;

    /**
     * Set all entries of the log at once replacing the current entries
     *
     * @param EntryInterface[] $entries
     * @return $this
     */
    public function setEntries(array $entries = []): static;

    /**
     * Add an entry to the log
     *
     * @param EntryInterface $entry
     * @return $this
     */
    public function addEntry(EntryInterface $entry): static;

    /**
     * Get all entries of the log
     *
     * @return EntryInterface[]
     */
    public function getEntries(): array;

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * Return the current element
     *
     * @return EntryInterface
     */
    public function current(): EntryInterface;

    /**
     * Offset to set
     *
     * @param mixed $offset
     * @param EntryInterface $value
     */
    public function offsetSet(mixed $offset, mixed $value): void;

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return EntryInterface
     */
    public function offsetGet(mixed $offset): EntryInterface;
}