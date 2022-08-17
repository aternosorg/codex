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
     * @var SolutionInterface[]
     */
    protected array $solutions = [];

    /**
     * @var int
     */
    protected int $iterator = 0;

    /**
     * Set all solutions at once in an array replacing the current solutions
     *
     * @param SolutionInterface[] $solutions
     * @return $this
     */
    public function setSolutions(array $solutions = []): static
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
    public function addSolution(SolutionInterface $solution): static
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
    public function current(): SolutionInterface
    {
        return $this->solutions[$this->iterator];
    }

    /**
     * Move forward to next element
     *
     * @return void
     */
    public function next(): void
    {
        $this->iterator++;
    }

    /**
     * Return the key of the current element
     *
     * @return int
     */
    public function key(): int
    {
        return $this->iterator;
    }

    /**
     * Checks if current position is valid
     *
     * @return boolean
     */
    public function valid(): bool
    {
        return array_key_exists($this->iterator, $this->solutions);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->iterator = 0;
    }

    /**
     * Count elements of an object
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->solutions);
    }

    /**
     * Whether an offset exists
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->solutions[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return SolutionInterface
     */
    public function offsetGet(mixed $offset): SolutionInterface
    {
        return $this->solutions[$offset];
    }

    /**
     * Offset to set
     *
     * @param mixed $offset
     * @param SolutionInterface $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->solutions[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param mixed $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->solutions[$offset]);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            "solutions" => $this->getSolutions()
        ]);
    }
}