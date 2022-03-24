<?php

namespace Aternos\Codex\Parser;

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\Line;

/**
 * Class DefaultParser
 *
 * @package Aternos\Codex\Parser
 */
class DefaultParser extends Parser
{
    /**
     * Parse a log from resource to Log object
     */
    public function parse()
    {
        foreach ($this->getLogContentAsArray() as $number => $logLineString) {
            $this->log->addEntry((new Entry())
                ->addLine(new Line($number + 1, $logLineString))
            );
        }
    }
}