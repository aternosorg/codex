<?php

namespace Aternos\Codex\Detective;

/**
 * Class LinePatternDetector
 *
 * @package Aternos\Codex\Detective
 */
class LinePatternDetector extends PatternDetector
{
    /**
     * Detect if the log matches
     *
     * Counts the lines matching the pattern and returns the percentage from 0-1 for the detective
     *
     * Returns false when no match is found
     *
     * @return bool|float
     */
    public function detect(): bool|float
    {
        $lines = $this->getLogContentAsArray();
        $matchingCounter = 0;
        foreach ($lines as $line) {
            if (preg_match($this->pattern, $line) === 1) {
                $matchingCounter++;
            }
        }

        if ($matchingCounter === 0) {
            return false;
        }

        return $matchingCounter / count($lines);
    }
}