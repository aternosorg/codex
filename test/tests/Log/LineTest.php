<?php

namespace Aternos\Codex\Test\Tests\Log;

use Aternos\Codex\Log\Line;
use PHPUnit\Framework\TestCase;

class LineTest extends TestCase
{
    public function testSetGetText(): void
    {
        $text = uniqid();
        $line = new Line("", 1);
        $this->assertSame($line, $line->setText($text));
        $this->assertEquals($text, $line->getText());
    }

    public function testSetGetNumber(): void
    {
        $number = rand(0, 100);
        $line = new Line("", 999);
        $this->assertSame($line, $line->setNumber($number));
        $this->assertEquals($number, $line->getNumber());
    }

    public function test__toString(): void
    {
        $text = uniqid();
        $line = new Line($text, 1);
        $this->assertSame($line, $line->setText($text));
        $this->assertEquals($text, (string)$line);
    }
}
