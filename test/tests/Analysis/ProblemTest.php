<?php

require_once __DIR__ . '/../../src/Analysis/TestProblem.php';
require_once __DIR__ . '/../../src/Analysis/TestSolution.php';

use PHPUnit\Framework\TestCase;

class ProblemTest extends TestCase
{

    public function testSetGetSolutions()
    {
        $problem = new TestProblem();
        $solution = new TestSolution();
        $this->assertSame($problem, $problem->setSolutions([$solution]));
        $this->assertEquals([$solution], $problem->getSolutions());
    }

    public function testAddSolutions()
    {
        $problem = new TestProblem();
        $solution = new TestSolution();
        $this->assertSame($problem, $problem->addSolution($solution));
        $this->assertEquals([$solution], $problem->getSolutions());
    }
}
