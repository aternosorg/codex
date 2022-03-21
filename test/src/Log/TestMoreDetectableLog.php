<?php

namespace Aternos\Codex\Test\Src\Log;

use Aternos\Codex\Detective\LinePatternDetector;
use Aternos\Codex\Log\DetectableLogInterface;
use Aternos\Codex\Log\Log;

/**
 * Class TestMoreDetectableLog
 */
class TestMoreDetectableLog extends Log implements DetectableLogInterface
{
    /**
     * Get an array of detectors matching DetectorInterface
     *
     * @return array
     */
    public static function getDetectors()
    {
        return [(new LinePatternDetector())->setPattern('/This/')];
    }
}