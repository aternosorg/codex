<?php

namespace Aternos\Codex\Analysis;

use Aternos\Codex\Log\EntryInterface;

/**
 * Interface InsightInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface InsightInterface
{
    /**
     * Get a human-readable message
     *
     * @return string
     */
    public function getMessage(): string;

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * Set the related entry
     *
     * @param EntryInterface $entry
     * @return $this
     */
    public function setEntry(EntryInterface $entry): static;

    /**
     * Get the related entry
     *
     * @return EntryInterface
     */
    public function getEntry(): EntryInterface;

    /**
     * Check if the $insight object is equal with the current object
     *
     * @param InsightInterface $insight
     * @return bool
     */
    public function isEqual(InsightInterface $insight): bool;

    /**
     * Increase the counter for this insight
     *
     * @return $this
     */
    public function increaseCounter(): static;

    /**
     * Get the current counter value
     *
     * @return int
     */
    public function getCounterValue(): int;
}