<?php

require_once __DIR__ . '/../../src/Analysis/TestInsight.php';
require_once __DIR__ . '/../../src/Analysis/TestProblem.php';
require_once __DIR__ . '/../../src/Analysis/TestInformation.php';

use Aternos\Codex\Analysis\Analysis;
use PHPUnit\Framework\TestCase;

class AnalysisTest extends TestCase
{
    public function testSetGetInsights()
    {
        $analysis = new Analysis();
        $insight = new TestInsight();
        $this->assertSame($analysis, $analysis->setInsights([$insight]));
        $this->assertSame([$insight], $analysis->getInsights());
    }

    public function testAddInsight()
    {
        $analysis = new Analysis();
        $insight = new TestInsight();
        $this->assertSame($analysis, $analysis->addInsight($insight));
        $this->assertSame([$insight], $analysis->getInsights());
    }

    public function testGetProblems()
    {
        $analysis = new Analysis();
        $problem = new TestProblem();
        $information = new TestInformation();

        $analysis->addInsight($problem);
        $analysis->addInsight($information);

        $this->assertEquals([$problem], $analysis->getProblems());
    }

    public function testGetInformation()
    {
        $analysis = new Analysis();
        $problem = new TestProblem();
        $information = new TestInformation();

        $analysis->addInsight($problem);
        $analysis->addInsight($information);

        $this->assertEquals([$information], $analysis->getInformation());
    }
}
