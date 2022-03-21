<?php

namespace Aternos\Codex\Test\Tests\Analysis;

use Aternos\Codex\Analysis\Analysis;
use Aternos\Codex\Test\Src\Analysis\TestInformation;
use Aternos\Codex\Test\Src\Analysis\TestInsight;
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
}
