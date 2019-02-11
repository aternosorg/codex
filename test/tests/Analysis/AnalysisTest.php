<?php

require_once __DIR__ . '/../../src/Analysis/TestInsight.php';

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
}
