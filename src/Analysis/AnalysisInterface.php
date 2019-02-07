<?php

namespace Aternos\Codex\Analysis;

/**
 * Interface AnalysisInterface
 *
 * @package Aternos\Codex\Analysis
 */
interface AnalysisInterface extends \Iterator, \Countable, \ArrayAccess
{
    /**
     * Set all problems at once in an array replacing the current problems
     *
     * @param array $problems
     * @return $this
     */
    public function setProblems(array $problems = []);

    /**
     * Add a problem
     *
     * @param ProblemInterface $problem
     * @return $this
     */
    public function addProblem(ProblemInterface $problem);

    /**
     * Get all problems
     *
     * @return array
     */
    public function getProblems(): array;
}