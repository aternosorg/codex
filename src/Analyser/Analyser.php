<?php

namespace Aternos\Codex\Analyser;

use Aternos\Codex\Log\AnalysableLogInterface;

/**
 * Class Analyser
 *
 * @package Aternos\Codex\Analyser
 */
abstract class Analyser implements AnalyserInterface
{
    /**
     * @var AnalysableLogInterface
     */
    protected $log;

    /**
     * Set the log
     *
     * @param AnalysableLogInterface $log
     * @return $this
     */
    public function setLog(AnalysableLogInterface $log)
    {
        $this->log = $log;
        return $this;
    }
}