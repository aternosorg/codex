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
        $line = new Line(1, uniqid());
        $this->assertSame($entry, $entry->addLine($line));
        $this->assertEquals([$line], $entry->getLines());
    }

    public function testSetGetLines(): void
    {
        $entry = new Entry();
        $line = new Line(1, uniqid());
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

    public function testKey(): void
    {
        $entry = new Entry();
        $line = (new Line())->setText(uniqid());

        $entry->addLine($line);
        foreach ($entry as $ignored) {
            // do nothing
        }
        $this->assertEquals(1, $entry->key());
    }


    public function testCount(): void
    {
        $entry = new Entry();
        $line1 = (new Line())->setText(uniqid());
        $line2 = (new Line())->setText(uniqid());

        $this->assertEquals(0, $entry->count());
        $entry->addLine($line1);
        $this->assertEquals(1, $entry->count());
        $entry->addLine($line2);
        $this->assertEquals(2, $entry->count());
    }

    public function testOffsetExists(): void
    {
        $entry = new Entry();
        $line = (new Line())->setText(uniqid());

        $this->assertArrayNotHasKey(0, $entry);
        $this->assertEquals(0, $entry->count());
        $entry->addLine($line);
        $this->assertArrayHasKey(0, $entry);
        $this->assertEquals($line, $entry[0]);
    }

    public function testOffsetGet(): void
    {
        $entry = new Entry();
        $line = (new Line())->setText(uniqid());
        $entry->addLine($line);

        // Exists
        $this->assertEquals($line, $entry[0]);

        // Does not exist -> "undefined array key" error
        $this->expectError();
        $this->assertEquals(null, $entry[1]);
    }

    public function testOffsetSet(): void
    {
        $entry = new Entry();
        $line1 = (new Line())->setText(uniqid());

        $this->assertArrayNotHasKey(0, $entry);
        $this->assertEquals(0, $entry->count());
        $entry->addLine($line1);
        $this->assertArrayHasKey(0, $entry);
        $this->assertEquals($line1, $entry[0]);

        // Overwrite $line1 on $entry[0] using the offsetSet
        $line2 = (new Line())->setText(uniqid());
        $entry[0] = $line2;
        $this->assertEquals($line2, $entry[0]);
    }

    public function testOffsetUnset(): void
    {
        $entry = new Entry();
        $line = (new Line())->setText(uniqid());

        $this->assertArrayNotHasKey(0, $entry);
        $this->assertEquals(0, $entry->count());
        $entry->addLine($line);
        $this->assertArrayHasKey(0, $entry);
        $this->assertEquals($line, $entry[0]);

        // Unset $line1 on $entry[0] using the offsetUnset
        unset($entry[0]);
        $this->assertArrayNotHasKey(0, $entry);
        $this->expectError();
        $this->assertEquals(null, $entry[1]);
    }
}
