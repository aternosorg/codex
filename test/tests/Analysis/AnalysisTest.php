<?php

namespace Aternos\Codex\Test\Tests\Analysis;

use Aternos\Codex\Analysis\Analysis;
use Aternos\Codex\Test\Src\Analysis\TestInformation;
use Aternos\Codex\Test\Src\Analysis\TestInsight;
use Aternos\Codex\Test\Src\Analysis\TestPatternProblem;
use Aternos\Codex\Test\Src\Analysis\TestProblem;
use PHPUnit\Framework\TestCase;

class AnalysisTest extends TestCase
{
    public function testSetGetInsights(): void
    {
        $analysis = new Analysis();
        $insight = new TestInsight();
        $this->assertSame($analysis, $analysis->setInsights([$insight]));
        $this->assertSame([$insight], $analysis->getInsights());
    }

    public function testAddInsight(): void
    {
        $analysis = new Analysis();
        $insight = new TestInsight();
        $this->assertSame($analysis, $analysis->addInsight($insight));
        $this->assertSame([$insight], $analysis->getInsights());
    }

    public function testGetProblems(): void
    {
        $analysis = new Analysis();
        $problem = new TestProblem();
        $information = new TestInformation();

        $analysis->addInsight($problem);
        $analysis->addInsight($information);

        $this->assertEquals([$problem], $analysis->getProblems());
    }

    public function testGetInformation(): void
    {
        $analysis = new Analysis();
        $problem = new TestProblem();
        $information = new TestInformation();

        $analysis->addInsight($problem);
        $analysis->addInsight($information);

        $this->assertEquals([$information], $analysis->getInformation());
    }

    public function testKey(): void
    {
        $analysis = new Analysis();
        $problem = new TestProblem();
        $information = new TestInformation();

        $analysis->addInsight($problem);
        $this->assertEquals(0, $analysis->key());
        $analysis->addInsight($information);
        $this->assertEquals(1, $analysis->key());
    }


    public function testCount(): void
    {
        $analysis = new Analysis();
        $problem = new TestProblem();
        $information = new TestInformation();

        $this->assertEquals(0, $analysis->count());
        $analysis->addInsight($problem);
        $this->assertEquals(1, $analysis->count());
        $analysis->addInsight($information);
        $this->assertEquals(2, $analysis->count());
    }

    public function testAddingTheSameInsightIncreasesInternalCounter(): void
    {
        // Adding the same insight to an analysis does not add it to the insights, and therefore it
        // does not increase the counter of the analysis, but the internal counter of the insight.
        // See Analysis->addInsight()

        $analysis = new Analysis();
        $problem = new TestPatternProblem();
        $problem2 = new TestPatternProblem();

        $analysis->addInsight($problem);
        $this->assertEquals(1, $analysis->count());
        $this->assertEquals(1, $problem->getCounterValue());

        $analysis->addInsight($problem2);
        $this->assertEquals(1, $analysis->count());
        $this->assertEquals(2, $problem->getCounterValue());
    }

    public function testOffsetExists(): void
    {
        $analysis = new Analysis();
        $information = new TestInformation();

        $this->assertArrayNotHasKey(0, $analysis);
        $this->assertEquals(0, $analysis->count());
        $analysis->addInsight($information);
        $this->assertArrayHasKey(0, $analysis);
        $this->assertEquals($information, $analysis[0]);
    }

    public function testOffsetGet(): void
    {
        $analysis = new Analysis();
        $information = new TestInformation();
        $analysis->addInsight($information);

        // Exists
        $this->assertEquals($information, $analysis[0]);

        // Does not exist -> "undefined array key" error
        $this->assertArrayNotHasKey(1, $analysis);
    }

    public function testOffsetSet(): void
    {
        $analysis = new Analysis();
        $information = new TestInformation();

        $this->assertArrayNotHasKey(0, $analysis);
        $this->assertEquals(0, $analysis->count());
        $analysis->addInsight($information);
        $this->assertArrayHasKey(0, $analysis);
        $this->assertEquals($information, $analysis[0]);

        // Overwrite $information on $analysis[0] using the offsetSet
        $problem = new TestProblem();
        $analysis[0] = $problem;
        $this->assertEquals($problem, $analysis[0]);
    }

    public function testOffsetUnset(): void
    {
        $analysis = new Analysis();
        $information = new TestInformation();

        $this->assertArrayNotHasKey(0, $analysis);
        $this->assertEquals(0, $analysis->count());
        $analysis->addInsight($information);
        $this->assertArrayHasKey(0, $analysis);
        $this->assertEquals($information, $analysis[0]);

        // Unset $information on $analysis[0] using the offsetUnset
        unset($analysis[0]);
        $this->assertArrayNotHasKey(0, $analysis);
        $this->assertArrayNotHasKey(1, $analysis);
    }
}
