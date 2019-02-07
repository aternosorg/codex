<?php

namespace Aternos\Codex\Analyser;

use Aternos\Codex\Analysis\Analysis;
use Aternos\Codex\Analysis\AnalysisInterface;
use Aternos\Codex\Analysis\PatternProblemInterface;
use Aternos\Codex\Log\EntryInterface;
use Aternos\Codex\Log\LogInterface;

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
    protected $possibleProblemClasses;

    /**
     * Set possible problem classes
     *
     * Every class must implement PatternProblemInterface
     *
     * @param array $problemClasses
     * @return $this
     */
    public function setPossibleProblemClasses(array $problemClasses)
    {
        $this->possibleProblemClasses = [];
        foreach ($problemClasses as $problemClass) {
            $this->addPossibleProblemClass($problemClass);
        }

        return $this;
    }

    /**
     * Add a possible problem class
     *
     * The class must implement PatternProblemInterface
     *
     * @param string $problemClass
     * @return $this
     */
    public function addPossibleProblemClass(string $problemClass)
    {
        if (!is_subclass_of($problemClass, PatternProblemInterface::class)) {
            throw new \InvalidArgumentException("Class " . $problemClass . " does not implement " . PatternProblemInterface::class . ".");
        }

        $this->possibleProblemClasses[] = $problemClass;
        return $this;
    }

    /**
     * Analyse a log and return an Analysis
     *
     * @param LogInterface $log
     * @return AnalysisInterface
     */
    public function analyse(LogInterface $log)
    {
        $analysis = new Analysis();

        foreach ($log as $entry) {
            foreach ($this->possibleProblemClasses as $possibleProblemClass) {
                /** @var PatternProblemInterface $possibleProblemClass */
                $patterns = $possibleProblemClass::getPatterns();
                foreach ($patterns as $patternKey => $pattern) {
                    $problem = $this->analyseEntry($entry, $possibleProblemClass, $patternKey, $pattern);
                    if ($problem) {
                        $analysis->addProblem($problem);
                    }
                }
            }
        }

        return $analysis;
    }

    /**
     * Compare the entry against the given pattern and create a problem object if it matches
     *
     * @param EntryInterface $entry
     * @param string $possibleProblemClass
     * @param $patternKey
     * @param string $pattern
     * @return bool|PatternProblemInterface
     */
    protected function analyseEntry(EntryInterface $entry, string $possibleProblemClass, $patternKey, string $pattern)
    {
        $result = preg_match($pattern, $entry, $matches);
        if (!$result) {
            return false;
        }

        /** @var PatternProblemInterface $problem */
        $problem = new $possibleProblemClass();
        $problem->setMatches($matches, $patternKey);

        return $problem;
    }
}