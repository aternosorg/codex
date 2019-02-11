<?php

namespace Aternos\Codex\Analyser;

use Aternos\Codex\Analysis\AnalysisInterface;
use Aternos\Codex\Log\AnalysableLogInterface;

/**
 * Interface AnalyserInterface
 *
 * @package Aternos\Codex\Analyser
 */
interface AnalyserInterface
{
    /**
     * Set the log
     *
     * @param AnalysableLogInterface $log
     * @return $this
     */
    public function setLog(AnalysableLogInterface $log);

    /**
     * Analyse a log and return an Analysis
     *
     * @return AnalysisInterface
     */
    public function analyse();
}