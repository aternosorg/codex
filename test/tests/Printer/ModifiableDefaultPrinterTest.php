<?php

namespace Aternos\Codex\Test\Tests\Printer;

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\File\StringLogFile;
use Aternos\Codex\Log\Line;
use Aternos\Codex\Log\Log;
use Aternos\Codex\Printer\ModifiableDefaultPrinter;
use Aternos\Codex\Test\Src\Printer\TestModification;
use PHPUnit\Framework\TestCase;

class ModifiableDefaultPrinterTest extends TestCase
{

    public function testPrint(): void
    {
        $logFile = new StringLogFile("This is foo!");
        $log = new Log();
        $log->setLogFile($logFile);
        $log->parse();

        $printer = new ModifiableDefaultPrinter();
        $printer->addModification(new TestModification());
        $printer->setLog($log);
        $this->assertEquals("This is bar!", trim($printer->print()));
    }

    public function testPrintEntry(): void
    {
        $entry = (new Entry())->addLine((new Line())->setText("This is foo!"));

        $printer = new ModifiableDefaultPrinter();
        $printer->addModification(new TestModification());
        $printer->setEntry($entry);
        $this->assertEquals("This is bar!", trim($printer->print()));
    }
}
