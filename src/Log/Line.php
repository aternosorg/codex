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
     * @var string
     */
    protected $text = "";

    /**
     * @var int
     */
    protected $number;

    /**
     * Set the text of the line
     *
     * @param string $text
     * @return Line
     */
    public function setText(string $text)
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
     * @return Line
     */
    public function setNumber(int $number)
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
    public function __toString()
    {
        return $this->getText();
    }
}