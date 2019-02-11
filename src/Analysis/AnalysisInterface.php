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
     * @param array $insights
     * @return $this
     */
    public function setInsights(array $insights = []);

    /**
     * Add an insight
     *
     * @param InsightInterface $insight
     * @return $this
     */
    public function addInsight(InsightInterface $insight);

    /**
     * Get all insights
     *
     * @return array
     */
    public function getInsights(): array;
}