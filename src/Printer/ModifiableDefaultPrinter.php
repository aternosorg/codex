<?php

namespace Aternos\Codex\Printer;

use Aternos\Codex\Log\LineInterface;

/**
 * Class ModifiableDefaultPrinter
 *
 * @package Aternos\Codex\Printer
 */
class ModifiableDefaultPrinter extends ModifiablePrinter
{
    /**
     * Print a line
     *
     * @param LineInterface $line
     * @return string
     */
    protected function printLine(LineInterface $line): string
    {
        return $this->runModifications($line->getText()) . PHP_EOL;
    }
}