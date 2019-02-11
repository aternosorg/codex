<?php

require_once __DIR__ . '/../../src/Log/TestAlwaysDetectableLog.php';
require_once __DIR__ . '/../../src/Log/TestLessDetectableLog.php';
require_once __DIR__ . '/../../src/Log/TestMoreDetectableLog.php';
require_once __DIR__ . '/../../src/Log/TestNeverDetectableLog.php';

use Aternos\Codex\Detective\Detective;
use Aternos\Codex\Log\Log;
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
