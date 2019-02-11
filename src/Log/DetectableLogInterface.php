<?php

namespace Aternos\Codex\Log;

/**
 * Interface DetectableLogInterface
 *
 * @package Aternos\Codex\Log
 */
interface DetectableLogInterface extends LogInterface
{
    /**
     * Get an array of detectors matching DetectorInterface
     *
     * @return array
     */
    public static function getDetectors();
}