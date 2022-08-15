<?php

namespace Aternos\Codex\Log;

/**
 * Class Line
 *
 * @package Aternos\Codex\Log
 */
class Line implements LineInterface
{
    /**
     * @param int $number
     * @param string $text
     */
    public function __construct(
        protected int    $number,
        protected string $text)
    {
    }

    /**
     * Set the text of the line
     *
     * @param string $text
     * @return $this
     */
    public function setText(string $text): static
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get the text of the line
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set the line number
     *
     * @param int $number
     * @return $this
     */
    public function setNumber(int $number): static
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get the line number
     *
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getText();
    }
}