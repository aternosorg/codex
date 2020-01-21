<?php

use Aternos\Codex\Detective\WeightedSinglePatternDetector;
use Aternos\Codex\Log\File\StringLogFile;
use PHPUnit\Framework\TestCase;

class WeightedSinglePatternDetectorTest extends TestCase
{
    public function testDetect()
    {
        $this->assertEquals(1, (new WeightedSinglePatternDetector())
            ->setLogFile(new \Aternos\Codex\Log\File\PathLogFile(__DIR__ . '/../../data/simple.log'))
            ->setPattern('/This/')
            ->setWeight(1)
            ->detect()
        );

        $this->assertEquals(0.5, (new WeightedSinglePatternDetector())
            ->setLogFile(new \Aternos\Codex\Log\File\PathLogFile(__DIR__ . '/../../data/simple.log'))
            ->setPattern('/This/')
            ->setWeight(0.5)
            ->detect()
        );

        $this->assertEquals(0, (new WeightedSinglePatternDetector())
            ->setLogFile(new \Aternos\Codex\Log\File\PathLogFile(__DIR__ . '/../../data/simple.log'))
            ->setPattern('/This/')
            ->setWeight(0)
            ->detect()
        );

        $this->assertFalse((new WeightedSinglePatternDetector())
            ->setLogFile(new StringLogFile("You cannot detect this."))
            ->setPattern('/missing/')
            ->detect()
        );
    }
}
