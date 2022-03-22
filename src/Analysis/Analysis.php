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
     * @var InsightInterface[]
     */
    protected $insights = [];

    /**
     * @var int
     */
    protected $iterator = 0;

    /**
     * Set all insights at once in an array replacing the current insights
     *
     * @param InsightInterface[] $insights
     * @return $this
     */
    public function setInsights(array $insights = [])
    {
        $this->insights = $insights;
        return $this;
    }

    /**
     * Add an insight
     *
     * @param InsightInterface $insight
     * @return $this
     */
    public function addInsight(InsightInterface $insight)
    {
        foreach ($this as $existingInsight) {
            if (get_class($insight) === get_class($existingInsight) && $existingInsight->isEqual($insight)) {
                $existingInsight->increaseCounter();
                return $this;
            }
        }

        $this->insights[] = $insight;
        return $this;
    }

    /**
     * Get all insights
     *
     * @return array
     */
    public function getInsights(): array
    {
        return $this->insights;
    }

    /**
     * Get all insights that are extended from $extendedFrom (class name)
     *
     * @param string $extendedFrom
     * @return array
     */
    public function getFilteredInsights($extendedFrom)
    {
        $returnInsights = [];
        foreach ($this->getInsights() as $insight) {
            if ($insight instanceof $extendedFrom) {
                $returnInsights[] = $insight;
            }
        }

        return $returnInsights;
    }

    /**
     * Get all problem insights
     *
     * @return array
     */
    public function getProblems(): array
    {
        return $this->getFilteredInsights(ProblemInterface::class);
    }

    /**
     * Get all information insights
     *
     * @return array
     */
    public function getInformation(): array
    {
        return $this->getFilteredInsights(InformationInterface::class);
    }

    /**
     * Return the current element
     *
     * @return InsightInterface
     */
    public function current(): InsightInterface
    {
        return $this->insights[$this->iterator];
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
        return array_key_exists($this->iterator, $this->insights);
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
        return count($this->insights);
    }

    /**
     * Whether an offset exists
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->insights[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return InsightInterface
     */
    public function offsetGet($offset): InsightInterface
    {
        return $this->insights[$offset];
    }

    /**
     * Offset to set
     *
     * @param $offset
     * @param InsightInterface $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->insights[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->insights[$offset]);
    }
}