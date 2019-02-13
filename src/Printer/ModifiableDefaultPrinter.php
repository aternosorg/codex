<?php

namespace Aternos\Codex\Printer;

/**
 * Class ModifiableDefaultPrinter
 *
 * @package Aternos\Codex\Printer
 */
class ModifiableDefaultPrinter extends ModifiablePrinter
{
    /**
     * Print the log
     *
     * @return string
     */
    public function print(): string
    {
        $return = "";
        foreach ($this->log as $entry) {
            foreach ($entry as $line) {
                $return .= $this->runModifications($line->getText()) . PHP_EOL;
            }
        }

        return $return;
    }
}