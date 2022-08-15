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
     * @return $this
     */
    public function setText(string $text): static;

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
     * @return $this
     */
    public function setNumber(int $number): static;

    /**
     * Get the line number
     *
     * @return int
     */
    public function getNumber(): int;

    /**
     * @return string
     */
    public function __toString(): string;
}