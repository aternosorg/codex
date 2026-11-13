<?php

namespace Aternos\Codex\Analyser;

use Aternos\Codex\Analysis\Analysis;
use Aternos\Codex\Analysis\AnalysisInterface;
use Aternos\Codex\Analysis\PatternInsightInterface;
use Aternos\Codex\Log\EntryInterface;
use InvalidArgumentException;

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
        $index = array_search($insightClass, $this->possibleInsightClasses, true);
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
     * Get the patterns of all possible insight classes
     *
     * getPatterns() often builds its patterns from string fragments, so calling it
     * for every entry of a log adds up. The result is only reused within one analysis,
     * so changes to the possible insight classes or their patterns still take effect.
     *
     * @return array<class-string<PatternInsightInterface>, string[]> The patterns of each insight class, keyed by class name
     */
    protected function resolvePatterns(): array
    {
        $patternsByClass = [];
        foreach ($this->possibleInsightClasses as $possibleInsightClass) {
            $patternsByClass[$possibleInsightClass] = $possibleInsightClass::getPatterns();
        }
        return $patternsByClass;
    }

    /**
     * Analyze a log and return an Analysis
     *
     * @return AnalysisInterface
     */
    public function analyse(): AnalysisInterface
    {
        $analysis = new Analysis();
        $analysis->setLog($this->log);

        $patternsByClass = $this->resolvePatterns();

        foreach ($this->log as $entry) {
            foreach ($this->analyseEntry($entry, $patternsByClass) as $insight) {
                $analysis->addInsight($insight);
            }
        }

        return $analysis;
    }

    /**
     * Compare an entry against all patterns and create an insight for every match
     *
     * @param EntryInterface $entry
     * @param array<class-string<PatternInsightInterface>, string[]> $patternsByClass The patterns from resolvePatterns()
     * @return PatternInsightInterface[]
     */
    protected function analyseEntry(EntryInterface $entry, array $patternsByClass): array
    {
        // Converting an entry to a string joins all of its lines, so it is done once here
        // and not for every pattern, which used to be most of the time spent analysing a log.
        $text = (string)$entry;

        $insights = [];
        foreach ($patternsByClass as $insightClass => $patterns) {
            foreach ($patterns as $patternKey => $pattern) {
                foreach ($this->findMatches($pattern, $text) as $matches) {
                    $insights[] = $this->createInsight($insightClass, $entry, $matches, $patternKey);
                }
            }
        }

        return $insights;
    }

    /**
     * Find all matches of a pattern in a text
     *
     * @param string $pattern
     * @param string $text
     * @return array<array<array-key, string>> One array of groups for every match, empty if the pattern does not match
     */
    protected function findMatches(string $pattern, string $text): array
    {
        $result = preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
        if ($result === false) {
            return [];
        }

        return $matches;
    }

    /**
     * Create an insight for a match of one of its patterns in an entry
     *
     * @param class-string<PatternInsightInterface> $insightClass
     * @param EntryInterface $entry The entry the pattern matched in
     * @param array<array-key, string> $matches The groups of the match
     * @param mixed $patternKey The key of the matching pattern in getPatterns()
     * @return PatternInsightInterface
     */
    protected function createInsight(string $insightClass, EntryInterface $entry, array $matches, mixed $patternKey): PatternInsightInterface
    {
        $insight = new $insightClass();
        $insight->setMatches($matches, $patternKey);
        $insight->setEntry($entry);

        return $insight;
    }
}
