<?php

namespace Aternos\Codex\Test\Tests\Log;

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\Log;
use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
    public function testAddEntry()
    {
        $log = new Log();
        $entry = (new Entry())->setLevel(rand(0, 100));
        $this->assertSame($log, $log->addEntry($entry));
        $this->assertEquals([$entry], $log->getEntries());
    }

    public function testSetGetEntries()
    {
        $log = new Log();
        $entry = (new Entry())->setLevel(rand(0, 100));
        $this->assertSame($log, $log->setEntries([$entry]));
        $this->assertEquals([$entry], $log->getEntries());
    }
}
