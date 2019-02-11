<?php

require_once __DIR__ . '/../../src/Analysis/TestProblem.php';

use Aternos\Codex\Analysis\Analysis;
use PHPUnit\Framework\TestCase;

class AnalysisTest extends TestCase
{
    public function testSetGetInsights()
    {
        $analysis = new Analysis();
        $problem = new TestProblem();
        $this->assertSame($analysis, $analysis->setInsights([$problem]));
        $this->assertSame([$problem], $analysis->getInsights());
    }

    public function testAddInsight()
    {
        $analysis = new Analysis();
        $problem = new TestProblem();
        $this->assertSame($analysis, $analysis->addInsight($problem));
        $this->assertSame([$problem], $analysis->getInsights());
    }
}
