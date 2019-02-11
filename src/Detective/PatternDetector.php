<?php

namespace Aternos\Codex\Detective;

/**
 * Class PatternDetector
 *
 * @package Aternos\Codex\Detective
 */
abstract class PatternDetector extends Detector
{
    /**
     * @var string
     */
    protected $pattern;

    /**
     * Set the matching pattern for one line
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern(string $pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }
}