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
    /**
     * Analyse a  log file with an analyser
     *
     * Every log type should have a default analyser,
     * but the $analyser argument can be used to override
     * the default analyser
     *
     * @param AnalyserInterface|null $analyser
     * @return AnalysisInterface
     */
    public function analyse(AnalyserInterface $analyser = null)
    {

        if ($analyser === null) {
            $analyser = static::getDefaultAnalyser();
        }

        return $analyser->analyse($this);
    }
}