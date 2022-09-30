<?php

namespace Aternos\Codex\Analyser;

use Aternos\Codex\Analysis\Analysis;
use Aternos\Codex\Analysis\AnalysisInterface;
use Aternos\Codex\Analysis\PatternInsightInterface;
use Aternos\Codex\Log\EntryInterface;
use InvalidArgumentException;

/**
 * Class PatternAnalyser
 *
 * @package Aternos\Codex\Analyser
 */
class PatternAnalyser extends Analyser
{
    /**
     * @var class-string<PatternInsightInterface>[]
     */
    protected array $possibleInsightClasses = [];

    /**
     * Set possible insight classes
     *
     * Every class must implement PatternInsightInterface
     *
     * @param class-string<PatternInsightInterface>[] $insightClasses
     * @return $this
     */
    public function setPossibleInsightClasses(array $insightClasses): static
    {
        $this->possibleInsightClasses = [];
        foreach ($insightClasses as $insightClass) {
            $this->addPossibleInsightClass($insightClass);
        }

        return $this;
    }

    /**
     * Add a possible insight class
     *
     * The class must implement PatternInsightInterface
     *
     * @param class-string<PatternInsightInterface> $insightClass
     * @return $this
     */
    public function addPossibleInsightClass(string $insightClass): static
    {
        if (!is_subclass_of($insightClass, PatternInsightInterface::class)) {
            throw new InvalidArgumentException("Class " . $insightClass . " does not implement " . PatternInsightInterface::class . ".");
        }

        $this->possibleInsightClasses[] = $insightClass;
        return $this;
    }

    /**
     * Find a possible insight class
     *
     * @param class-string<PatternInsightInterface> $insightClass
     * @return int
     */
    protected function findPossibleInsightClass(string $insightClass): int
    {
        $index = array_search($insightClass, $this->possibleInsightClasses);
        if ($index === false) {
            throw new InvalidArgumentException("Class " . $insightClass . " not found in possible insight classes.");
        }
        return $index;
    }

    /**
     * Remove a possible insight class
     *
     * @param class-string<PatternInsightInterface> $insightClass
     */
    public function removePossibleInsightClass(string $insightClass): void
    {
        $index = $this->findPossibleInsightClass($insightClass);
        unset($this->possibleInsightClasses[$index]);
    }

    /**
     * Override a possible insight class with a child class
     *
     * The $childInsightClass has to extend $parentInsightClass
     *
     * @param class-string<PatternInsightInterface> $parentInsightClass
     * @param class-string<PatternInsightInterface> $childInsightClass
     */
    public function overridePossibleInsightClass(string $parentInsightClass, string $childInsightClass): void
    {
        if (!is_subclass_of($childInsightClass, $parentInsightClass)) {
            throw new InvalidArgumentException("Class " . $childInsightClass . " does not extend " . $parentInsightClass . ".");
        }

        $index = $this->findPossibleInsightClass($parentInsightClass);
        $this->possibleInsightClasses[$index] = $childInsightClass;
    }

    /**
     * Analyse a log and return an Analysis
     *
     * @return AnalysisInterface
     */
    public function analyse(): AnalysisInterface
    {
        $analysis = new Analysis();
        $analysis->setLog($this->log);

        foreach ($this->log as $entry) {
            foreach ($this->possibleInsightClasses as $possibleInsightClass) {
                /** @var PatternInsightInterface $possibleInsightClass */
                $patterns = $possibleInsightClass::getPatterns();
                foreach ($patterns as $patternKey => $pattern) {
                    $insights = $this->analyseEntry($entry, $possibleInsightClass, $patternKey, $pattern);
                    if ($insights) {
                        foreach ($insights as $insight) {
                            $analysis->addInsight($insight);
                        }
                    }
                }
            }
        }

        return $analysis;
    }

    /**
     * Compare the entry against the given pattern and create an insight object if it matches
     *
     * @param EntryInterface $entry
     * @param string $possibleInsightClass
     * @param mixed $patternKey
     * @param string $pattern
     * @return null|PatternInsightInterface[]
     */
    protected function analyseEntry(EntryInterface $entry, string $possibleInsightClass, mixed $patternKey, string $pattern): ?array
    {
        $result = preg_match_all($pattern, $entry, $matches, PREG_SET_ORDER);
        if ($result === false || $result === 0) {
            return null;
        }

        $return = [];
        foreach ($matches as $match) {
            /** @var PatternInsightInterface $insight */
            $insight = new $possibleInsightClass();
            $insight->setMatches($match, $patternKey);
            $insight->setEntry($entry);

            $return[] = $insight;
        }

        return $return;
    }
}