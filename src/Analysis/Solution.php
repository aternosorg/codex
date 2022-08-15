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
    public function __toString(): string
    {
        return $this->getMessage();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'message' => $this->getMessage()
        ];
    }
}