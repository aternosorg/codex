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
    protected array $insights = [];
    protected int $iterator = 0;

    /**
     * Set all insights at once in an array replacing the current insights
     *
     * @param InsightInterface[] $insights
     * @return $this
     */
    public function setInsights(array $insights = []): static
    {
        $this->insights = $insights;
        return $this;
    }

    /**
     * Add an insight.
     * If the insight already exists, we increase its counter.
     *
     * @param InsightInterface $insight
     * @return $this
     */
    public function addInsight(InsightInterface $insight): static
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
     * @return InsightInterface[]
     */
    public function getInsights(): array
    {
        return $this->insights;
    }

    /**
     * Get all insights that are extended from $extendedFrom (class name)
     *
     * @param class-string<InsightInterface> $extendedFrom
     * @return InsightInterface[]
     */
    public function getFilteredInsights(string $extendedFrom): array
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
     * @return ProblemInterface[]
     */
    public function getProblems(): array
    {
        return $this->getFilteredInsights(ProblemInterface::class);
    }

    /**
     * Get all information insights
     *
     * @return InformationInterface[]
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
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->insights[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return InsightInterface
     */
    public function offsetGet(mixed $offset): InsightInterface
    {
        return $this->insights[$offset];
    }

    /**
     * Offset to set
     *
     * @param mixed $offset
     * @param InsightInterface $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->insights[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param mixed $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->insights[$offset]);
    }
}