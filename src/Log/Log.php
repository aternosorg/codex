<?php

namespace Aternos\Codex\Log;

use Aternos\Codex\Log\File\LogFileInterface;
use Aternos\Codex\Parser\DefaultParser;
use Aternos\Codex\Parser\ParserInterface;

/**
 * Class Log
 *
 * @package Aternos\Codex\Log
 */
class Log implements LogInterface
{
    /**
     * @var EntryInterface[]
     */
    protected array $entries = [];
    protected int $iterator = 0;
    protected ?LogFileInterface $logFile = null;

    /**
     * Get the default parser
     *
     * @return ParserInterface
     */
    public static function getDefaultParser(): ParserInterface
    {
        return new DefaultParser();
    }

    /**
     * Set the log file
     *
     * @param LogFileInterface $logFile
     * @return $this
     */
    public function setLogFile(LogFileInterface $logFile): static
    {
        $this->logFile = $logFile;
        return $this;
    }

    /**
     * Get the log file
     *
     * @return LogFileInterface
     */
    public function getLogfile(): LogFileInterface
    {
        return $this->logFile;
    }

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
    public function parse(?ParserInterface $parser = null): static
    {
        if ($parser === null) {
            $parser = static::getDefaultParser();
        }

        $parser->setLog($this)->parse();

        return $this;
    }

    /**
     * Set all entries of the log at once replacing the current entries
     *
     * @param EntryInterface[] $entries
     * @return $this
     */
    public function setEntries(array $entries = []): static
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
    public function addEntry(EntryInterface $entry): static
    {
        $this->entries[] = $entry;
        return $this;
    }

    /**
     * Get all entries of the log
     *
     * @return EntryInterface[]
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * Return the current element
     *
     * @return EntryInterface
     */
    public function current(): EntryInterface
    {
        return $this->entries[$this->iterator];
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
        return array_key_exists($this->iterator, $this->entries);
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
        return count($this->entries);
    }

    /**
     * Whether an offset exists
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->entries[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return EntryInterface
     */
    public function offsetGet(mixed $offset): EntryInterface
    {
        return $this->entries[$offset];
    }

    /**
     * Offset to set
     *
     * @param mixed $offset
     * @param EntryInterface $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->entries[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param mixed $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->entries[$offset]);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode("\n", $this->getEntries());
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            "entries" => $this->getEntries()
        ];
    }
}