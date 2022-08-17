<?php

namespace Aternos\Codex\Test\Src\Log;

use Aternos\Codex\Detective\DetectorInterface;
use Aternos\Codex\Detective\SinglePatternDetector;
use Aternos\Codex\Log\DetectableLogInterface;
use Aternos\Codex\Log\Log;

/**
 * Class TestNeverDetectableLog
 */
class TestNeverDetectableLog extends Log implements DetectableLogInterface
{
    /**
     * Get an array of detectors matching DetectorInterface
     *
     * @return DetectorInterface[]
     */
    public static function getDetectors(): array
    {
        return [(new SinglePatternDetector())->setPattern('/missing/')];
    }
}