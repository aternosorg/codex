<?php

namespace Aternos\Codex\Log;

use Aternos\Codex\Detective\DetectorInterface;

interface DetectableLogInterface extends LogInterface
{
    /**
     * Get an array of detectors matching DetectorInterface
     *
     * @return DetectorInterface[]
     */
    public static function getDetectors(): array;
}