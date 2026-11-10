<?php

namespace Aternos\Codex\Parser;

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\Line;

class DefaultParser extends Parser
{
    /**
     * Parse a log from resource to Log object
     */
    public function parse(): void
    {
        foreach ($this->getLogContentAsArray() as $number => $logLineString) {
            $this->log->addEntry((new Entry())
                ->addLine(new Line($number + 1, $logLineString))
            );
        }
    }
}