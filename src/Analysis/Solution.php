<?php

namespace Aternos\Codex\Analysis;

/**
 * Class Solution
 *
 * @package Aternos\Codex\Analysis
 */
abstract class Solution implements SolutionInterface
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}