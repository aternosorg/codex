<?php

namespace Aternos\Codex\Printer;

use Aternos\Codex\Log\LineInterface;

/**
 * Class DefaultPrinter
 *
 * @package Aternos\Codex\Printer
 */
class DefaultPrinter extends Printer
{
    /**
     * Print a line
     *
     * @param LineInterface $line
     * @return string
     */
    protected function printLine(LineInterface $line): string
    {
        return $line->getText() . PHP_EOL;
    }
}