<?php

use Aternos\Codex\Analysis\Insight;

/**
 * Class TestInsight
 */
class TestInsight extends Insight
{
    /**
     * Get the insight as human readable message
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
     * @param static $insight
     * @return bool
     */
    public function isEqual($insight): bool
    {
        return false;
    }
}