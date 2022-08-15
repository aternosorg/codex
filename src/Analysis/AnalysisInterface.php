<?php

namespace Aternos\Codex\Analysis;

/**
 * Interface AnalysisInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface AnalysisInterface extends \Iterator, \Countable, \ArrayAccess
{
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
}