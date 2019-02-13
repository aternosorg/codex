<?php

namespace Aternos\Codex\Printer;

/**
 * Interface ModificationInterface
 *
 * @package Aternos\Codex\Printer
 */
interface ModificationInterface
{
    /**
     * Modify the given string and return it
     *
     * @param string $text
     * @return string
     */
    public function modify(string $text): string;
}