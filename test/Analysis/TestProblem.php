<?php

use Aternos\Codex\Analysis\Problem;

/**
 * Class TestProblem
 */
class TestProblem extends Problem
{
    /**
     * Get the problem as human readable message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return "This is a test problem";
    }

    /**
     * Check if the $problem object is equal with the current object
     *
     * @param static $problem
     * @return bool
     */
    public function isEqual($problem): bool
    {
        return false;
    }
}