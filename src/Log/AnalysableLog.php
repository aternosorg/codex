<?php

namespace Aternos\Codex\Log;

use Aternos\Codex\Analyser\AnalyserInterface;
use Aternos\Codex\Analysis\AnalysisInterface;

/**
 * Class AnalysableLog
 *
 * @package Aternos\Codex\Log
 */
abstract class AnalysableLog extends Log implements AnalysableLogInterface
{
    protected ?AnalysisInterface $analysis = null;

    /**
     * Analyse a log file with an analyser
     *
     * Every log type should have a default analyser,
     * but the $analyser argument can be used to override
     * the default analyser
     *
     * @param AnalyserInterface|null $analyser
     * @return AnalysisInterface
     */
    public function analyse(AnalyserInterface $analyser = null): AnalysisInterface
    {
        if ($this->analysis !== null) {
            return $this->analysis;
        }

        if ($analyser === null) {
            $analyser = static::getDefaultAnalyser();
        }

        $analyser->setLog($this);
        return $this->analysis = $analyser->analyse();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'analysis' => $this->analyse()
        ]);
    }
}