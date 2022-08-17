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

    public function testKey(): void
    {
        $problem = new TestProblem();
        $solution = new TestSolution();

        $problem->addSolution($solution);
        /** @noinspection PhpStatementHasEmptyBodyInspection */
        foreach ($problem as $ignored) {
            // do nothing
        }
        $this->assertEquals(1, $problem->key());
    }


    public function testCount(): void
    {
        $problem = new TestProblem();
        $solution1 = new TestSolution();
        $solution2 = new TestSolution();

        $this->assertEquals(0, $problem->count());
        $problem->addSolution($solution1);
        $this->assertEquals(1, $problem->count());
        $problem->addSolution($solution2);
        $this->assertEquals(2, $problem->count());
    }

    public function testOffsetExists(): void
    {
        $problem = new TestProblem();
        $solution = new TestSolution();

        $this->assertArrayNotHasKey(0, $problem);
        $this->assertEquals(0, $problem->count());
        $problem->addSolution($solution);
        $this->assertArrayHasKey(0, $problem);
        $this->assertEquals($solution, $problem[0]);
    }

    public function testOffsetGet(): void
    {
        $problem = new TestProblem();
        $solution = new TestSolution();
        $problem->addSolution($solution);

        // Exists
        $this->assertEquals($solution, $problem[0]);

        // Does not exist -> "undefined array key" error
        $this->expectError();
        $this->assertEquals(null, $problem[1]);
    }

    public function testOffsetSet(): void
    {
        $problem = new TestProblem();
        $solution1 = new TestSolution();

        $this->assertArrayNotHasKey(0, $problem);
        $this->assertEquals(0, $problem->count());
        $problem->addSolution($solution1);
        $this->assertArrayHasKey(0, $problem);
        $this->assertEquals($solution1, $problem[0]);

        // Overwrite $solution1 on $problem[0] using the offsetSet
        $TestSolution2 = new TestSolution();
        $problem[0] = $TestSolution2;
        $this->assertEquals($TestSolution2, $problem[0]);
    }

    public function testOffsetUnset(): void
    {
        $problem = new TestProblem();
        $solution = new TestSolution();

        $this->assertArrayNotHasKey(0, $problem);
        $this->assertEquals(0, $problem->count());
        $problem->addSolution($solution);
        $this->assertArrayHasKey(0, $problem);
        $this->assertEquals($solution, $problem[0]);

        // Unset $solution on $problem[0] using the offsetUnset
        unset($problem[0]);
        $this->assertArrayNotHasKey(0, $problem);
        $this->expectError();
        $this->assertEquals(null, $problem[1]);
    }
}
