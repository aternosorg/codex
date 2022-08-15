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
     * Get an array of detectors matching DetectorInterface
     *
     * @return DetectorInterface[]
     */
    public static function getDetectors(): array;
}