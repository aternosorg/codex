<?php

namespace Aternos\Codex\Test\Tests\Detector;

use Aternos\Codex\Detective\Detective;
use Aternos\Codex\Log\Log;
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
    protected function getDetective(array $possibleLogClasses)
    {
        $detective = new Detective();
        $detective->setLogFile(new \Aternos\Codex\Log\File\PathLogFile(__DIR__ . '/../../data/simple.log'));
        $detective->setPossibleLogClasses($possibleLogClasses);
        return $detective;
    }

    public function testDetect()
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
}
