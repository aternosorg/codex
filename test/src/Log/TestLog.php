<?php

use Aternos\Codex\Log\Log;
use Aternos\Codex\Parser\DefaultParser;

/**
 * Class TestLog
 */
class TestLog extends Log
{
    /**
     * Get the default parser
     *
     * @return DefaultParser
     */
    public static function getDefaultParser()
    {
        return new DefaultParser();
    }

    /**
     * Get the default analyser
     */
    public static function getDefaultAnalyser()
    {
        throw new BadMethodCallException();
    }
}