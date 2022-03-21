<?php

namespace Aternos\Codex\Test\Tests\Analysis;

use Aternos\Codex\Test\Src\Analysis\TestProblem;
use Aternos\Codex\Test\Src\Analysis\TestSolution;
use PHPUnit\Framework\TestCase;

class ProblemTest extends TestCase
{

    public function testSetGetSolutions(): void
    {
        $problem = new TestProblem();
        $solution = new TestSolution();
        $this->assertSame($problem, $problem->setSolutions([$solution]));
        $this->assertEquals([$solution], $problem->getSolutions());
    }

    public function testAddSolutions(): void
    {
        $problem = new TestProblem();
        $solution = new TestSolution();
        $this->assertSame($problem, $problem->addSolution($solution));
        $this->assertEquals([$solution], $problem->getSolutions());
    }
}
