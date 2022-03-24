<?php

namespace Aternos\Codex\Printer;

/**
 * Class PatternModification
 *
 * @package Aternos\Codex\Printer
 */
class PatternModification extends Modification
{
    /**
     * @var string
     */
    protected string $pattern;

    /**
     * @var string
     */
    protected string $replacement;

    /**
     * @param string $pattern
     * @param string $replacement
     */
    public function __construct(string $pattern, string $replacement)
    {
        $this->pattern = $pattern;
        $this->replacement = $replacement;
    }

    /**
     * Set the pattern
     *
     * See http://php.net/manual/de/function.preg-replace.php
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern(string $pattern): PatternModification
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * Set the replacement string
     *
     * See http://php.net/manual/de/function.preg-replace.php
     *
     * @param string $replacement
     * @return $this
     */
    public function setReplacement(string $replacement): PatternModification
    {
        $this->replacement = $replacement;
        return $this;
    }

    /**
     * Modify the given string and return it
     *
     * @param string $text
     * @return string
     */
    public function modify(string $text): string
    {
        return preg_replace($this->pattern, $this->replacement, $text);
    }
}