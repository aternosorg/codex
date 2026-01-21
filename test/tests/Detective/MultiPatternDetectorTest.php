<?php

namespace Aternos\Codex\Test\Tests\Detective;

use Aternos\Codex\Detective\MultiPatternDetector;
use Aternos\Codex\Log\File\StringLogFile;
use PHPUnit\Framework\TestCase;

class MultiPatternDetectorTest extends TestCase
{
    public function testDetectSinglePattern(): void
    {
        $this->assertTrue((new MultiPatternDetector())
            ->setLogFile(new StringLogFile("You can detect this."))
            ->addPattern('/detect/')
            ->detect()
        );
    }

    public function testDetectMultiplePatterns(): void
    {
        $this->assertTrue((new MultiPatternDetector())
            ->setLogFile(new StringLogFile("You can detect this and this."))
            ->addPattern('/detect/')
            ->addPattern('/and this/')
            ->detect()
        );
    }

    public function testNotDetectMissingFromMultiplePatterns(): void
    {
        $this->assertFalse((new MultiPatternDetector())
            ->setLogFile(new StringLogFile("You can detect this and this."))
            ->addPattern('/detect/')
            ->addPattern('/and this/')
            ->addPattern('/but not this/')
            ->detect()
        );
    }
}
