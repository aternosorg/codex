<?php

namespace Aternos\Codex\Test\Src\Analysis;

use Aternos\Codex\Analysis\InsightInterface;
use Aternos\Codex\Analysis\PatternInsightInterface;
use Aternos\Codex\Analysis\Problem;

/**
 * Class TestPatternProblem
 */
class TestPatternProblem extends Problem implements PatternInsightInterface
{
    protected ?string $cause = null;

    /**
     * @param string $cause
     * @return TestPatternProblem
     */
    public function setCause(string $cause): static
    {
        $this->cause = $cause;
        return $this;
    }

    /**
     * Get an array of possible patterns
     *
     * The array key of the pattern will be passed to setMatches()
     *
     * @return array
     */
    public static function getPatterns(): array
    {
        return ['/I have a problem with (\w+)/'];
    }

    /**
     * Apply the matches from the pattern
     *
     * @param array $matches
     * @param mixed $patternKey
     * @return void
     */
    public function setMatches(array $matches, mixed $patternKey): void
    {
        $this->cause = $matches[1];
    }

    /**
     * Get the problem as human-readable message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return "There is a problem with " . $this->cause;
    }

    /**
     * Check if the $insight object is equal with the current object
     *
     * @param InsightInterface $insight
     * @return bool
     */
    public function isEqual(InsightInterface $insight): bool
    {
        return $insight instanceof static && $this->cause === $insight->cause;
    }
}