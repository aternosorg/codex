<?php

require_once __DIR__ . '/TestProblem.php';

use Aternos\Codex\Analysis\Analysis;
use PHPUnit\Framework\TestCase;

class AnalysisTest extends TestCase
{

    public function testSetGetProblems()
    {
        $analysis = new Analysis();
        $problem = new TestProblem();
        $this->assertSame($analysis, $analysis->setProblems([$problem]));
        $this->assertSame([$problem], $analysis->getProblems());
    }

    public function testAddProblem()
    {
        $analysis = new Analysis();
        $problem = new TestProblem();
        $this->assertSame($analysis, $analysis->addProblem($problem));
        $this->assertSame([$problem], $analysis->getProblems());
    }
}
