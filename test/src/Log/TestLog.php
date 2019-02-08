<?php

use Aternos\Codex\Log\Log;

/**
 * Class TestLog
 */
class TestLog extends Log
{
    /**
     * Get the default parser
     */
    public static function getDefaultParser()
    {
        throw new BadMethodCallException();
    }

    /**
     * Get the default analyser
     */
    public static function getDefaultAnalyser()
    {
        throw new BadMethodCallException();
    }
}