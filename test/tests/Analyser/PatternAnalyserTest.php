<?php

require_once __DIR__ . '/../../src/Analysis/TestPatternProblem.php';
require_once __DIR__ . '/../../src/Log/TestPatternLog.php';

use Aternos\Codex\Analysis\Analysis;
use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\File\PathLogFile;
use Aternos\Codex\Log\Line;
use PHPUnit\Framework\TestCase;

class PatternAnalyserTest extends TestCase
{
    /**
     * @return Analysis
     */
    protected function getExpectedAnalysis()
    {
        $analysis = (new Analysis())
            ->addInsight((new TestPatternProblem())
                ->setCause("ABC")
                ->setEntry((new Entry())->setTime(2)->setLevel("ERROR")
                    ->addLine((new Line())->setNumber(2)->setText("[01.01.1970 00:00:02] [Log/ERROR] I have a problem with ABC"))
                )
            )
            ->addInsight((new TestPatternProblem())
                ->setCause("XYZ")
                ->setEntry((new Entry())->setTime(4)->setLevel("ERROR")
                    ->addLine((new Line())->setNumber(4)->setText("[01.01.1970 00:00:04] [Log/ERROR] I have a problem with XYZ"))
                )
            );

        return $analysis;
    }

    public function testAnalyse()
    {
        $logFile = new PathLogFile(__DIR__ . '/../../data/problem.log');
        $log = (new TestPatternLog())->setLogFile($logFile);
        $log->parse();

        $analysis = $log->analyse();
        $this->assertEquals($this->getExpectedAnalysis()->getInsights(), $analysis->getInsights());
    }
}
