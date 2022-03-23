<?php

namespace Aternos\Codex\Test\Tests\Log;

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\Line;
use PHPUnit\Framework\TestCase;

class EntryTest extends TestCase
{

    public function testAddLine(): void
    {
        $entry = new Entry();
        $line = new Line(uniqid(), 1);
        $this->assertSame($entry, $entry->addLine($line));
        $this->assertEquals([$line], $entry->getLines());
    }

    public function testSetGetLines(): void
    {
        $entry = new Entry();
        $line = new Line(uniqid(), 1);
        $this->assertSame($entry, $entry->setLines([$line]));
        $this->assertEquals([$line], $entry->getLines());
    }

    public function testSetGetLevel(): void
    {
        $entry = new Entry();
        $level = rand(0, 100);
        $this->assertSame($entry, $entry->setLevel($level));
        $this->assertEquals($level, $entry->getLevel());
    }

    public function testSetGetTime(): void
    {
        $entry = new Entry();
        $time = time();
        $this->assertSame($entry, $entry->setTime($time));
        $this->assertEquals($time, $entry->getTime());
    }
}
