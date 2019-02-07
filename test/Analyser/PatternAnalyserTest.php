<?php

require_once __DIR__ . '/../Analysis/TestPatternProblem.php';

use Aternos\Codex\Analysis\Analysis;
use Aternos\Codex\Analyser\PatternAnalyser;
use Aternos\Codex\Parser\PatternParser;
use PHPUnit\Framework\TestCase;

class PatternAnalyserTest extends TestCase
{
    /**
     * @return Analysis
     */
    protected function getExpectedAnalysis()
    {
        $analysis = (new Analysis())
            ->addProblem((new TestPatternProblem())->setCause("ABC"))
            ->addProblem((new TestPatternProblem())->setCause("XYZ"));

        return $analysis;
    }

    public function testAnalyse()
    {
        $parser = (new PatternParser())
            ->setString(file_get_contents(__DIR__ . '/../data/problem.log'))
            ->setPattern('/\[([^\]]+)\] \[[^\/]+\/([^\]]+)\].*/')
            ->setMatches([PatternParser::TIME, PatternParser::LEVEL])
            ->setTimeFormat('d.m.Y H:i:s');
        $log = $parser->parse();

        $analyser = (new PatternAnalyser())->addPossibleProblemClass(TestPatternProblem::class);
        $analysis = $analyser->analyse($log);
        $this->assertEquals($this->getExpectedAnalysis()->getProblems(), $analysis->getProblems());
    }
}
