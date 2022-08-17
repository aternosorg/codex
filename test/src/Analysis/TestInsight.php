<?php

namespace Aternos\Codex\Test\Src\Analysis;

use Aternos\Codex\Analysis\Insight;
use Aternos\Codex\Analysis\InsightInterface;

/**
 * Class TestInsight
 */
class TestInsight extends Insight
{
    /**
     * Get the insight as human-readable message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return "This is a test insight";
    }

    /**
     * Check if the $insight object is equal with the current object
     *
     * @param InsightInterface $insight
     * @return bool
     */
    public function isEqual(InsightInterface $insight): bool
    {
        return false;
    }
}