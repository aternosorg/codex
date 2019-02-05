<?php

namespace Aternos\Codex\Log;

/**
 * Interface LineInterface
 *
 * @package Aternos\Codex\Log
 */
interface LineInterface
{
    /**
     * Set the text of the line
     *
     * @param string $text
     * @return static
     */
    public function setText(string $text);

    /**
     * Get the text of the line
     *
     * @return string
     */
    public function getText(): string;

    /**
     * Set the line number
     *
     * @param int $number
     * @return static
     */
    public function setNumber(int $number);

    /**
     * Get the line number
     *
     * @return int
     */
    public function getNumber(): int;

    /**
     * @return string
     */
    public function __toString();
}