<?php

namespace Aternos\Codex\Analysis;

use ArrayAccess;
use Countable;
use Iterator;

/**
 * Interface ProblemInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface ProblemInterface extends Iterator, Countable, ArrayAccess, InsightInterface
{
    /**
     * Set all solutions at once in an array replacing the current solutions
     *
     * @param SolutionInterface[] $solutions
     * @return $this
     */
    public function setSolutions(array $solutions = []): static;

    /**
     * Add a solution
     *
     * @param SolutionInterface $solution
     * @return $this
     */
    public function addSolution(SolutionInterface $solution): static;

    /**
     * Get all solutions
     *
     * @return SolutionInterface[]
     */
    public function getSolutions(): array;
}