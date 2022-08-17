<?php

namespace Aternos\Codex\Detective;

/**
 * Class PatternDetector
 *
 * @package Aternos\Codex\Detective
 */
abstract class PatternDetector extends Detector
{
    protected ?string $pattern = null;

    /**
     * Set the matching pattern for one line
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern(string $pattern): static
    {
        $this->pattern = $pattern;
        return $this;
    }
}