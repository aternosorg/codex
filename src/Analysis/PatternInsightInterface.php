<?php

namespace Aternos\Codex\Analysis;

/**
 * Interface PatternInsightInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface PatternInsightInterface extends InsightInterface
{
    /**
     * Get an array of possible patterns
     *
     * The array key of the pattern will be passed to setMatches()
     *
     * @return string[]
     */
    public static function getPatterns(): array;

    /**
     * Apply the matches from the pattern
     *
     * @param array $matches
     * @param mixed $patternKey
     * @return void
     */
    public function setMatches(array $matches, mixed $patternKey): void;
}