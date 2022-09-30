<?php

namespace Aternos\Codex\Analysis;

use Aternos\Codex\Log\EntryInterface;
use Aternos\Codex\Log\LogInterface;

/**
 * Class Insight
 *
 * @package Aternos\Codex\Analysis
 */
abstract class Insight implements InsightInterface
{
    protected ?AnalysisInterface $analysis = null;
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'message' => $this->getMessage(),
            'counter' => $this->getCounterValue(),
            'entry' => $this->getEntry()
        ];
    }

    /**
     * Set the related analysis
     *
     * @param AnalysisInterface $analysis
     * @return $this
     */
    public function setAnalysis(AnalysisInterface $analysis): static
    {
        $this->analysis = $analysis;
        return $this;
    }

    /**
     * Get the related analysis
     *
     * @return AnalysisInterface|null
     */
    public function getAnalysis(): ?AnalysisInterface
    {
        return $this->analysis;
    }

    /**
     * @return LogInterface|null
     */
    protected function getLog(): ?LogInterface
    {
        return $this->getAnalysis()?->getLog();
    }

    /**
     * @return string|null
     */
    protected function getLogContent(): ?string
    {
        return $this->getLog()?->getLogFile()?->getContent();
    }
}