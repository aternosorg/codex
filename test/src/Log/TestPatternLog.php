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
    public static function getDefaultParser()
    {
        return (new PatternParser())
            ->setPattern('/\[([^\]]+)\] \[[^\/]+\/([^\]]+)\].*/')
            ->setMatches([PatternParser::TIME, PatternParser::LEVEL])
            ->setTimeFormat('d.m.Y H:i:s');
    }

    /**
     * Get the default analyser
     *
     * @return AnalyserInterface
     */
    public static function getDefaultAnalyser()
    {
        return (new PatternAnalyser())
            ->addPossibleInsightClass(TestPatternProblem::class)
            ->addPossibleInsightClass(TestPatternInformation::class);
    }
}