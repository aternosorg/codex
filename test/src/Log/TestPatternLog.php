<?php

require_once __DIR__ . '/../../src/Analysis/TestPatternProblem.php';

use Aternos\Codex\Analyser\AnalyserInterface;
use Aternos\Codex\Analyser\PatternAnalyser;
use Aternos\Codex\Log\Log;
use Aternos\Codex\Parser\PatternParser;

/**
 * Class TestLog
 */
class TestPatternLog extends Log
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
            ->addPossibleInsightClass(TestPatternProblem::class);
    }
}