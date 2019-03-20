<?php

namespace Aternos\Codex\Analyser;

use Aternos\Codex\Analysis\Analysis;
use Aternos\Codex\Analysis\AnalysisInterface;
use Aternos\Codex\Analysis\PatternInsightInterface;
use Aternos\Codex\Log\EntryInterface;

/**
 * Class PatternAnalyser
 *
 * @package Aternos\Codex\Analyser
 */
class PatternAnalyser extends Analyser
{
    /**
     * @var array
     */
    protected $possibleInsightClasses = [];

    /**
     * Set possible insight classes
     *
     * Every class must implement PatternInsightInterface
     *
     * @param array $insightClasses
     * @return $this
     */
    public function setPossibleInsightClasses(array $insightClasses)
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
     * @param string $insightClass
     * @return $this
     */
    public function addPossibleInsightClass(string $insightClass)
    {
        if (!is_subclass_of($insightClass, PatternInsightInterface::class)) {
            throw new \InvalidArgumentException("Class " . $insightClass . " does not implement " . PatternInsightInterface::class . ".");
        }

        $this->possibleInsightClasses[] = $insightClass;
        return $this;
    }

    /**
     * Analyse a log and return an Analysis
     *
     * @return AnalysisInterface
     */
    public function analyse()
    {
        $analysis = new Analysis();

        foreach ($this->log as $entry) {
            foreach ($this->possibleInsightClasses as $possibleInsightClass) {
                /** @var PatternInsightInterface $possibleInsightClass */
                $patterns = $possibleInsightClass::getPatterns();
                foreach ($patterns as $patternKey => $pattern) {
                    $insight = $this->analyseEntry($entry, $possibleInsightClass, $patternKey, $pattern);
                    if ($insight) {
                        $analysis->addInsight($insight);
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
     * @param $patternKey
     * @param string $pattern
     * @return bool|PatternInsightInterface
     */
    protected function analyseEntry(EntryInterface $entry, string $possibleInsightClass, $patternKey, string $pattern)
    {
        $result = preg_match($pattern, $entry, $matches);
        if ($result !== 1) {
            return false;
        }

        /** @var PatternInsightInterface $insight */
        $insight = new $possibleInsightClass();
        $insight->setMatches($matches, $patternKey);
        $insight->setEntry($entry);

        return $insight;
    }
}