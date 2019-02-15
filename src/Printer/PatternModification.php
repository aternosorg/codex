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
    protected $pattern;

    /**
     * @var string
     */
    protected $replacement;

    /**
     * Set the pattern
     *
     * See http://php.net/manual/de/function.preg-replace.php
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern(string $pattern)
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
    public function setReplacement(string $replacement)
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