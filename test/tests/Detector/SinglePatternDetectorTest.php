<?php

namespace Aternos\Codex\Test\Tests\Detector;

use Aternos\Codex\Detective\SinglePatternDetector;
use Aternos\Codex\Log\File\StringLogFile;
use PHPUnit\Framework\TestCase;

class SinglePatternDetectorTest extends TestCase
{
    public function testDetect(): void
    {
        $this->assertTrue((new SinglePatternDetector())
            ->setLogFile(new StringLogFile("You can detect this."))
            ->setPattern('/detect/')
            ->detect()
        );

        $this->assertFalse((new SinglePatternDetector())
            ->setLogFile(new StringLogFile("You cannot detect this."))
            ->setPattern('/missing/')
            ->detect()
        );
    }
}
