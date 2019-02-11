<?php

use Aternos\Codex\Detective\SinglePatternDetector;
use Aternos\Codex\Log\DetectableLogInterface;
use Aternos\Codex\Log\Log;

/**
 * Class TestAlwaysDetectableLog
 */
class TestAlwaysDetectableLog extends Log implements DetectableLogInterface
{
    /**
     * Get an array of detectors matching DetectorInterface
     *
     * @return array
     */
    public static function getDetectors()
    {
        return [(new SinglePatternDetector())->setPattern('/information/')];
    }
}