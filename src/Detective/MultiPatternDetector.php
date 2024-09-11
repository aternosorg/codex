<?php

namespace Aternos\Codex\Detective;

/**
 * MultiPatternDetector can detect multiple patterns in a log and return true if all patterns are found
 */
class MultiPatternDetector extends Detector
{
    protected array $patterns = [];

    /**
     * Add a pattern to the list of patterns to detect
     *
     * @param string $pattern
     * @return $this
     */
    public function addPattern(string $pattern): static
    {
        $this->patterns[] = $pattern;
        return $this;
    }

    /**
     * Detects if the log matches all patterns
     *
     * Returns true if all patterns are found, false otherwise
     *
     * @return bool|float
     */
    public function detect(): bool|float
    {
        foreach ($this->patterns as $pattern) {
            if (preg_match($pattern, $this->getLogContent()) !== 1) {
                return false;
            }
        }

        return true;
    }
}