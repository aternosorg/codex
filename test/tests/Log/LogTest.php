<?php

namespace Aternos\Codex\Test\Tests\Log;

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\Log;
use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
    public function testAddEntry(): void
    {
        $log = new Log();
        $entry = (new Entry())->setLevel(rand(0, 100));
        $this->assertSame($log, $log->addEntry($entry));
        $this->assertEquals([$entry], $log->getEntries());
    }

    public function testSetGetEntries(): void
    {
        $log = new Log();
        $entry = (new Entry())->setLevel(rand(0, 100));
        $this->assertSame($log, $log->setEntries([$entry]));
        $this->assertEquals([$entry], $log->getEntries());
    }


    public function testKey(): void
    {
        $log = new Log();
        $entry = (new Entry())->setLevel(rand(0, 100));

        $log->addEntry($entry);
        foreach ($log as $ignored) {
            // do nothing
        }
        $this->assertEquals(1, $log->key());
    }


    public function testCount(): void
    {
        $log = new Log();
        $entry1 = (new Entry())->setLevel(rand(0, 100));
        $entry2 = (new Entry())->setLevel(rand(0, 100));

        $this->assertEquals(0, $log->count());
        $log->addEntry($entry1);
        $this->assertEquals(1, $log->count());
        $log->addEntry($entry2);
        $this->assertEquals(2, $log->count());
    }

    public function testOffsetExists(): void
    {
        $log = new Log();
        $entry = (new Entry())->setLevel(rand(0, 100));

        $this->assertArrayNotHasKey(0, $log);
        $this->assertEquals(0, $log->count());
        $log->addEntry($entry);
        $this->assertArrayHasKey(0, $log);
        $this->assertEquals($entry, $log[0]);
    }

    public function testOffsetGet(): void
    {
        $log = new Log();
        $entry = (new Entry())->setLevel(rand(0, 100));
        $log->addEntry($entry);

        // Exists
        $this->assertEquals($entry, $log[0]);

        // Does not exist -> "undefined array key" error
        $this->expectError();
        $this->assertEquals(null, $log[1]);
    }

    public function testOffsetSet(): void
    {
        $log = new Log();
        $entry1 = (new Entry())->setLevel(rand(0, 100));

        $this->assertArrayNotHasKey(0, $log);
        $this->assertEquals(0, $log->count());
        $log->addEntry($entry1);
        $this->assertArrayHasKey(0, $log);
        $this->assertEquals($entry1, $log[0]);

        // Overwrite $entry1 on $log[0] using the offsetSet
        $entry2 = (new Entry())->setLevel(rand(0, 100));
        $log[0] = $entry2;
        $this->assertEquals($entry2, $log[0]);
    }

    public function testOffsetUnset(): void
    {
        $log = new Log();
        $entry = (new Entry())->setLevel(rand(0, 100));

        $this->assertArrayNotHasKey(0, $log);
        $this->assertEquals(0, $log->count());
        $log->addEntry($entry);
        $this->assertArrayHasKey(0, $log);
        $this->assertEquals($entry, $log[0]);

        // Unset $entry on $log[0] using the offsetUnset
        unset($log[0]);
        $this->assertArrayNotHasKey(0, $log);
        $this->expectError();
        $this->assertEquals(null, $log[1]);
    }
}
