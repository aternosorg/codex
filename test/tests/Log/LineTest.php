<?php

use Aternos\Codex\Log\Line;
use PHPUnit\Framework\TestCase;

class LineTest extends TestCase
{
    public function testSetGetText()
    {
        $text = uniqid();
        $line = new Line();
        $this->assertSame($line, $line->setText($text));
        $this->assertEquals($text, $line->getText());
    }

    public function testSetGetNumber()
    {
        $number = rand(0, 100);
        $line = new Line();
        $this->assertSame($line, $line->setNumber($number));
        $this->assertEquals($number, $line->getNumber());
    }

    public function test__toString()
    {
        $text = uniqid();
        $line = new Line();
        $this->assertSame($line, $line->setText($text));
        $this->assertEquals($text, (string)$line);
    }
}
