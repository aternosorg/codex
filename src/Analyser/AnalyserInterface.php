<?php

namespace Aternos\Codex\Analyser;

use Aternos\Codex\Analysis\AnalysisInterface;
use Aternos\Codex\Log\LogInterface;

/**
 * Interface AnalyserInterface
 *
 * @package Aternos\Codex\Analyser
 */
interface AnalyserInterface
{
    /**
     * Analyse a log and return an Analysis
     *
     * @param LogInterface $log
     * @return AnalysisInterface
     */
    public function analyse(LogInterface $log);
}