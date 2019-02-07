<?php

require_once __DIR__ . '/../Analysis/TestPatternProblem.php';

use Aternos\Codex\Analysis\Analysis;
use Aternos\Codex\Analyser\PatternAnalyser;
use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\Line;
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
            ->addProblem((new TestPatternProblem())
                ->setCause("ABC")
                ->setEntry((new Entry())->setTime(2)->setLevel("ERROR")
                    ->addLine((new Line())->setNumber(2)->setText("[01.01.1970 00:00:02] [Log/ERROR] I have a problem with ABC"))
                )
            )
            ->addProblem((new TestPatternProblem())
                ->setCause("XYZ")
                ->setEntry((new Entry())->setTime(4)->setLevel("ERROR")
                    ->addLine((new Line())->setNumber(4)->setText("[01.01.1970 00:00:04] [Log/ERROR] I have a problem with XYZ"))
                )
            );

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
