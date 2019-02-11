<?php

namespace Aternos\Codex\Log;

use Aternos\Codex\Detective\DetectorInterface;

/**
 * Interface DetectableLogInterface
 *
 * @package Aternos\Codex\Log
 */
interface DetectableLogInterface extends LogInterface
{
    /**
     * Get the default analyser
     *
     * @return DetectorInterface
     */
    public static function getDetector();
}