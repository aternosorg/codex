<?php

namespace Aternos\Codex\Test\Tests\Analysis;

use Aternos\Codex\Log\File\PathLogFile;
use Aternos\Codex\Test\Src\Analysis\TestInformation;
use Aternos\Codex\Test\Src\Analysis\TestPatternInformation;
use Aternos\Codex\Test\Src\Log\TestPatternLog;
use PHPUnit\Framework\TestCase;

class InformationTest extends TestCase
{

    public function testSetGetValue(): void
    {
        $value = uniqid();
        $information = new TestInformation();
        $information->setValue($value);
        $this->assertEquals($value, $information->getValue());
    }

    public function testGetLabel(): void
    {
        $this->assertEquals("Label", (new TestInformation())->getLabel());
    }

    public function testGetMessage(): void
    {
        $value = uniqid();
        $information = new TestInformation();
        $information->setValue($value);
        $this->assertEquals("Label: " . $value, $information->getMessage());
        $this->assertEquals("Label: " . $value, (string)$information);
    }

    public function testIsEqual(): void
    {
        $value = uniqid();
        $informationA = new TestInformation();
        $informationA->setValue($value);
        $informationB = new TestInformation();
        $informationB->setValue($value);

        $this->assertTrue($informationA->isEqual($informationB));
        $this->assertTrue($informationA->isEqual($informationA));
    }

    public function testGetLogContent(): void
    {
        $logFile = new PathLogFile(__DIR__ . '/../../data/problem.log');
        $log = (new TestPatternLog())->setLogFile($logFile);
        $log->parse();

        $analysis = $log->analyse();
        foreach ($analysis->getInformation() as $information) {
            /** @var TestPatternInformation $information */
            $this->assertNotNull($information->getLogContent());
            $this->assertEquals($logFile->getContent(), $information->getLogContent());
        }
    }
}
