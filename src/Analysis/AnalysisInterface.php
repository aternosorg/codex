<?php

namespace Aternos\Codex\Analysis;

use ArrayAccess;
use Aternos\Codex\Log\AnalysableLogInterface;
use Aternos\Codex\Log\LogInterface;
use Countable;
use Iterator;
use JsonSerializable;

/**
 * Interface AnalysisInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface AnalysisInterface extends Iterator, Countable, ArrayAccess, JsonSerializable
{
    /**
     * Set the log
     *
     * @param LogInterface $log
     * @return $this
     */
    public function setLog(LogInterface $log): static;

    /**
     * Get the log
     *
     * @return LogInterface|null
     */
    public function getLog(): ?LogInterface;

    /**
     * Set all insights at once in an array replacing the current insights
     *
     * @param InsightInterface[] $insights
     * @return $this
     */
    public function setInsights(array $insights = []): static;

    /**
     * Add an insight
     *
     * @param InsightInterface $insight
     * @return $this
     */
    public function addInsight(InsightInterface $insight): static;

    /**
     * Get all insights
     *
     * @return InsightInterface[]
     */
    public function getInsights(): array;

    /**
     * Get all problem insights
     *
     * @return ProblemInterface[]
     */
    public function getProblems(): array;

    /**
     * Get all information insights
     *
     * @return InformationInterface[]
     */
    public function getInformation(): array;

    /**
     * Get all insights that are extended from $extendedFrom (class name)
     *
     * @param class-string<InsightInterface> $extendedFrom
     * @return InsightInterface[]
     */
    public function getFilteredInsights(string $extendedFrom): array;
}