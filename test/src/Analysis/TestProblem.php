<?php

namespace Aternos\Codex\Test\Src\Analysis;

use Aternos\Codex\Analysis\InsightInterface;
use Aternos\Codex\Analysis\Problem;

/**
 * Class TestProblem
 */
class TestProblem extends Problem
{
    /**
     * Get the problem as human-readable message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return "This is a test problem";
    }

    /**
     * Check if the $insight object is equal with the current object
     *
     * @param InsightInterface $insight
     * @return bool
     */
    public function isEqual(InsightInterface $insight): bool
    {
        return false;
    }
}