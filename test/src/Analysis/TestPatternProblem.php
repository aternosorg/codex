<?php

namespace Aternos\Codex\Test\Src\Analysis;

use Aternos\Codex\Analysis\PatternInsightInterface;
use Aternos\Codex\Analysis\Problem;

/**
 * Class TestPatternProblem
 */
class TestPatternProblem extends Problem implements PatternInsightInterface
{
    /**
     * @var string
     */
    protected $cause;

    /**
     * @param $cause
     * @return TestPatternProblem
     */
    public function setCause($cause)
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
     * @param $patternKey
     * @return void
     */
    public function setMatches(array $matches, $patternKey): void
    {
        $this->cause = $matches[1];
    }

    /**
     * Get the problem as human readable message
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
     * @param static $insight
     * @return bool
     */
    public function isEqual($insight): bool
    {
        return $this->cause === $insight->cause;
    }
}