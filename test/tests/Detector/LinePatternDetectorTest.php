<?php

namespace Aternos\Codex\Test\Tests\Detector;

use Aternos\Codex\Detective\LinePatternDetector;
use PHPUnit\Framework\TestCase;

class LinePatternDetectorTest extends TestCase
{
    public function testDetect(): void
    {
        $this->assertEquals(5 / 7, (new LinePatternDetector())
            ->setLogFile(new \Aternos\Codex\Log\File\PathLogFile(__DIR__ . '/../../data/simple.log'))
            ->setPattern('/information/')
            ->detect()
        );

        $this->assertFalse((new LinePatternDetector())
            ->setLogFile(new \Aternos\Codex\Log\File\PathLogFile(__DIR__ . '/../../data/simple.log'))
            ->setPattern('/missing/')
            ->detect()
        );

        $this->assertEquals(1, (new LinePatternDetector())
            ->setLogFile(new \Aternos\Codex\Log\File\PathLogFile(__DIR__ . '/../../data/simple.log'))
            ->setPattern('/This/')
            ->detect()
        );
    }
}
