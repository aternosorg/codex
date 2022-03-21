<?php

namespace Aternos\Codex\Test\Src\Analysis;

use Aternos\Codex\Analysis\Information;
use Aternos\Codex\Analysis\PatternInsightInterface;

/**
 * Class TestPatternInformation
 */
class TestPatternInformation extends Information implements PatternInsightInterface
{
    protected $label = "Software version";

    /**
     * Get an array of possible patterns
     *
     * The array key of the pattern will be passed to setMatches()
     *
     * @return array
     */
    public static function getPatterns(): array
    {
        return ['/This log was generated by software (v[0-9\.]*)/'];
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
        $this->value = $matches[1];
    }
}