<?php

namespace Aternos\Codex\Printer;

/**
 * Class DefaultPrinter
 *
 * @package Aternos\Codex\Printer
 */
class DefaultPrinter extends Printer
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
                $return .= $line->getText() . PHP_EOL;
            }
        }

        return $return;
    }
}