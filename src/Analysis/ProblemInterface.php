<?php

namespace Aternos\Codex\Analysis;

/**
 * Interface ProblemInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface ProblemInterface extends \Iterator, \Countable, \ArrayAccess
{
    /**
     * Get the problem as human readable message
     *
     * @return string
     */
    public function getMessage(): string;
    public function __toString();

    /**
     * Set all solutions at once in an array replacing the current solutions
     *
     * @param array $solutions
     * @return $this
     */
    public function setSolutions(array $solutions = []);

    /**
     * Add a solution
     *
     * @param SolutionInterface $solution
     * @return $this
     */
    public function addSolution(SolutionInterface $solution);

    /**
     * Get all solutions
     *
     * @return array
     */
    public function getSolutions(): array;

    /**
     * Check if the $problem object is equal with the current object
     *
     * @param static $problem
     * @return bool
     */
    public function isEqual($problem): bool;
}