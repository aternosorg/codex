<?php

namespace Aternos\Codex\Analysis;

use Aternos\Codex\Log\EntryInterface;

/**
 * Class Insight
 *
 * @package Aternos\Codex\Analysis
 */
abstract class Insight implements InsightInterface
{
    protected ?EntryInterface $entry = null;
    protected int $counter = 1;

    /**
     * Set the related entry
     *
     * @param EntryInterface $entry
     * @return $this
     */
    public function setEntry(EntryInterface $entry): static
    {
        $this->entry = $entry;
        return $this;
    }

    /**
     * Get the related entry
     *
     * @return EntryInterface
     */
    public function getEntry(): EntryInterface
    {
        return $this->entry;
    }

    /**
     * Increase the counter for this insight
     *
     * @return $this
     */
    public function increaseCounter(): static
    {
        $this->counter++;
        return $this;
    }

    /**
     * Get the current counter value
     *
     * @return int
     */
    public function getCounterValue(): int
    {
        return $this->counter;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getMessage();
    }
}