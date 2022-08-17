<?php

namespace Aternos\Codex\Test\Tests\Detector;

use Aternos\Codex\Detective\Detective;
use Aternos\Codex\Detective\DetectorInterface;
use Aternos\Codex\Log\DetectableLogInterface;
use Aternos\Codex\Log\Log;
use Aternos\Codex\Test\Src\Analysis\TestSolution;
use Aternos\Codex\Test\Src\Log\TestAlwaysDetectableLog;
use Aternos\Codex\Test\Src\Log\TestLessDetectableLog;
use Aternos\Codex\Test\Src\Log\TestMoreDetectableLog;
use Aternos\Codex\Test\Src\Log\TestNeverDetectableLog;
use PHPUnit\Framework\TestCase;

class DetectiveTest extends TestCase
{
    /**
     * @param array $possibleLogClasses
     * @return Detective
     */
    protected function getDetective(array $possibleLogClasses): Detective
    {
        $detective = new Detective();
        $detective->setLogFile(new \Aternos\Codex\Log\File\PathLogFile(__DIR__ . '/../../data/simple.log'));
        $detective->setPossibleLogClasses($possibleLogClasses);
        return $detective;
    }

    public function testDetect(): void
    {
        $this->assertEquals(TestAlwaysDetectableLog::class,
            get_class($this->getDetective([
                TestAlwaysDetectableLog::class,
                TestLessDetectableLog::class,
                TestMoreDetectableLog::class,
                TestNeverDetectableLog::class])->detect()));

        $this->assertEquals(TestMoreDetectableLog::class,
            get_class($this->getDetective([
                TestLessDetectableLog::class,
                TestMoreDetectableLog::class,
                TestNeverDetectableLog::class])->detect()));

        $this->assertEquals(TestLessDetectableLog::class,
            get_class($this->getDetective([
                TestLessDetectableLog::class,
                TestNeverDetectableLog::class])->detect()));

        $this->assertEquals(Log::class,
            get_class($this->getDetective([
                TestNeverDetectableLog::class])->detect()));
    }

    public function testAddPossibleLogClassThrowsExceptionIfPossibleClassDoesNotImplementDetectableLogInterface(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Class " . TestSolution::class . " does not implement " . DetectableLogInterface::class . ".");
        (new Detective())->addPossibleLogClass(TestSolution::class);
    }

    public function testDetectThrowsExceptionIfDetectorClassDoesNotImplementDetectorInterface(): void
    {
        $invalidDetectorClass = new class {
            // Is empty and not a child class of DetectorInterface
        };

        $customLogClass = new class() extends Log implements DetectableLogInterface {
            private static array $detectors = [];

            public static function setDetectors($detectors): void
            {
                self::$detectors = $detectors;
            }

            public static function getDetectors(): array
            {
                return self::$detectors;
            }
        };

        $customLogClass::setDetectors([$invalidDetectorClass]);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Class " . get_class($invalidDetectorClass) . " does not implement " . DetectorInterface::class . ".");
        $this->getDetective([get_class($customLogClass)])->detect();
    }
}
