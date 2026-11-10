<?php

namespace Aternos\Codex\Analyser;

use Aternos\Codex\Log\AnalysableLogInterface;

abstract class Analyser implements AnalyserInterface
{
    protected ?AnalysableLogInterface $log = null;

    /**
     * Set the log
     *
     * @param AnalysableLogInterface $log
     * @return $this
     */
    public function setLog(AnalysableLogInterface $log): static
    {
        $this->log = $log;
        return $this;
    }
}