<?php

namespace Aternos\Codex\Test\Src\Log;

use Aternos\Codex\Analyser\AnalyserInterface;
use Aternos\Codex\Analyser\PatternAnalyser;
use Aternos\Codex\Log\AnalysableLog;
use Aternos\Codex\Parser\PatternParser;
use Aternos\Codex\Test\Src\Analysis\TestPatternInformation;
use Aternos\Codex\Test\Src\Analysis\TestPatternProblem;

/**
 * Class TestLog
 */
class TestPatternLog extends AnalysableLog
{
    /**
     * Get the default parser
     *
     * @return PatternParser
     */
    public static function getDefaultParser(): PatternParser
    {
        return (new PatternParser())
            ->setPattern('/\[([^\]]+)\] \[[^\/]+\/([^\]]+)\].*/')
            ->setMatches([PatternParser::TIME, PatternParser::LEVEL])
            ->setTimeFormat('d.m.Y H:i:s');
    }

    /**
     * Get the default analyser
     *
     * @return PatternAnalyser
     */
    public static function getDefaultAnalyser(): PatternAnalyser
    {
        return (new PatternAnalyser())
            ->addPossibleInsightClass(TestPatternProblem::class)
            ->addPossibleInsightClass(TestPatternInformation::class);
    }
}