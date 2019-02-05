<?php

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\Line;
use PHPUnit\Framework\TestCase;

class EntryTest extends TestCase
{

    public function testAddLine()
    {
        $entry = new Entry();
        $line = (new Line())->setText(uniqid());
        $this->assertSame($entry, $entry->addLine($line));
        $this->assertEquals([$line], $entry->getLines());
    }

    public function testSetGetLines()
    {
        $entry = new Entry();
        $line = (new Line())->setText(uniqid());
        $this->assertSame($entry, $entry->setLines([$line]));
        $this->assertEquals([$line], $entry->getLines());
    }

    public function testSetGetLevel()
    {
        $entry = new Entry();
        $level = rand(0, 100);
        $this->assertSame($entry, $entry->setLevel($level));
        $this->assertEquals($level, $entry->getLevel());
    }
}
