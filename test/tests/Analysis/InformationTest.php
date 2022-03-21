<?php

namespace Aternos\Codex\Test\Tests\Analysis;

use Aternos\Codex\Test\Src\Analysis\TestInformation;
use PHPUnit\Framework\TestCase;

class InformationTest extends TestCase
{

    public function testSetGetValue()
    {
        $value = uniqid();
        $information = new TestInformation();
        $information->setValue($value);
        $this->assertEquals($value, $information->getValue());
    }

    public function testGetLabel()
    {
        $this->assertEquals("Label", (new TestInformation())->getLabel());
    }

    public function testGetMessage()
    {
        $value = uniqid();
        $information = new TestInformation();
        $information->setValue($value);
        $this->assertEquals("Label: " . $value, $information->getMessage());
        $this->assertEquals("Label: " . $value, (string)$information);
    }

    public function testIsEqual()
    {
        $value = uniqid();
        $informationA = new TestInformation();
        $informationA->setValue($value);
        $informationB = new TestInformation();
        $informationB->setValue($value);

        $this->assertTrue($informationA->isEqual($informationB));
        $this->assertTrue($informationA->isEqual($informationA));
    }
}
