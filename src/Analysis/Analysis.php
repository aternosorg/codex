<?php

namespace Aternos\Codex\Analysis;

/**
 * Class Analysis
 *
 * @package Aternos\Codex\Analysis
 */
class Analysis implements AnalysisInterface
{
    /**
     * @var array
     */
    protected $problems = [];

    /**
     * @var int
     */
    protected $iterator = 0;

    /**
     * Set all problems at once in an array replacing the current problems
     *
     * @param array $problems
     * @return $this
     */
    public function setProblems(array $problems = [])
    {
        $this->problems = $problems;
        return $this;
    }

    /**
     * Add a problem
     *
     * @param ProblemInterface $problem
     * @return $this
     */
    public function addProblem(ProblemInterface $problem)
    {
        foreach ($this as $existingProblem) {
            if (get_class($problem) === get_class($existingProblem) && $existingProblem->isEqual($problem)) {
                return $this;
            }
        }

        $this->problems[] = $problem;
        return $this;
    }

    /**
     * Get all problems
     *
     * @return array
     */
    public function getProblems(): array
    {
        return $this->problems;
    }

    /**
     * Return the current element
     *
     * @return ProblemInterface
     */
    public function current()
    {
        return $this->problems[$this->iterator];
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
        return array_key_exists($this->iterator, $this->problems);
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
        return count($this->problems);
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
     * @return ProblemInterface
     */
    public function offsetGet($offset)
    {
        return $this->problems[$offset];
    }

    /**
     * Offset to set
     *
     * @param $offset
     * @param ProblemInterface $value
     */
    public function offsetSet($offset, $value)
    {
        $this->problems[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->problems[$offset]);
    }
}