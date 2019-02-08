<?php

require_once __DIR__  . '/../../src/Log/TestLog.php';

use Aternos\Codex\Log\Entry;
use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
    public function testAddEntry()
    {
        $log = new TestLog();
        $entry = (new Entry())->setLevel(rand(0, 100));
        $this->assertSame($log, $log->addEntry($entry));
        $this->assertEquals([$entry], $log->getEntries());
    }

    public function testSetGetEntries()
    {
        $log = new TestLog();
        $entry = (new Entry())->setLevel(rand(0, 100));
        $this->assertSame($log, $log->setEntries([$entry]));
        $this->assertEquals([$entry], $log->getEntries());
    }
}
