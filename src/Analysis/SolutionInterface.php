<?php

namespace Aternos\Codex\Analysis;

/**
 * Interface SolutionInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface SolutionInterface
{
    /**
     * Get the solution as a human-readable message
     *
     * @return string
     */
    public function getMessage(): string;
    public function __toString(): string;
}