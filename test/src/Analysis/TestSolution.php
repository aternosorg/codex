<?php

namespace Aternos\Codex\Test\Src\Analysis;

use Aternos\Codex\Analysis\Solution;

/**
 * Class TestSolution
 */
class TestSolution extends Solution
{
    /**
     * Get the solution as a human readable message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return "This is a test solution.";
    }
}