<?php

namespace Aternos\Codex\Analysis;

/**
 * Class Problem
 *
 * @package Aternos\Codex\Analysis
 */
abstract class Problem extends Insight implements ProblemInterface
{
    /**
     * @var array
     */
    protected $solutions;

    /**
     * @var int
     */
    protected $iterator = 0;

    /**
     * Set all solutions at once in an array replacing the current solutions
     *
     * @param array $solutions
     * @return $this
     */
    public function setSolutions(array $solutions = [])
    {
        $this->solutions = $solutions;
        return $this;
    }

    /**
     * Add a solution
     *
     * @param SolutionInterface $solution
     * @return $this
     */
    public function addSolution(SolutionInterface $solution)
    {
        $this->solutions[] = $solution;
        return $this;
    }

    /**
     * Get all solutions
     *
     * @return array
     */
    public function getSolutions(): array
    {
        return $this->solutions;
    }

    /**
     * Return the current element
     *
     * @return SolutionInterface
     */
    public function current()
    {
        return $this->solutions[$this->iterator];
    }

    /**
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
        $this->iterator++;
    }

    /**
     * Return the key of the current element
     *
     * @return int
     */
    public function key()
    {
        return $this->iterator;
    }

    /**
     * Checks if current position is valid
     *
     * @return boolean
     */
    public function valid()
    {
        return array_key_exists($this->iterator, $this->solutions);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind()
    {
        $this->iterator = 0;
    }

    /**
     * Count elements of an object
     *
     * @return int
     */
    public function count()
    {
        return count($this->solutions);
    }

    /**
     * Whether a offset exists
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->result[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return SolutionInterface
     */
    public function offsetGet($offset)
    {
        return $this->solutions[$offset];
    }

    /**
     * Offset to set
     *
     * @param $offset
     * @param SolutionInterface $value
     */
    public function offsetSet($offset, $value)
    {
        $this->solutions[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->solutions[$offset]);
    }
}