<?php

use Aternos\Codex\Analysis\PatternProblemInterface;
use Aternos\Codex\Analysis\Problem;

/**
 * Class TestPatternProblem
 */
class TestPatternProblem extends Problem implements PatternProblemInterface
{
    /**
     * @var string
     */
    public $cause;

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
     * @return mixed
     */
    public function setMatches(array $matches, $patternKey)
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
     * Check if the $problem object is equal with the current object
     *
     * @param static $problem
     * @return bool
     */
    public function isEqual($problem): bool
    {
        return $this->cause === $problem->cause;
    }
}