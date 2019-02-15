<?php

require_once __DIR__ . "/../../src/Printer/TestModification.php";

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\File\StringLogFile;
use Aternos\Codex\Log\Line;
use Aternos\Codex\Log\Log;
use Aternos\Codex\Printer\ModifiableDefaultPrinter;
use PHPUnit\Framework\TestCase;

class ModifiableDefaultPrinterTest extends TestCase
{

    public function testPrint()
    {
        $logFile = new StringLogFile("This is foo!");
        $log = new Log();
        $log->setLogFile($logFile);
        $log->parse();

        $printer = new ModifiableDefaultPrinter();
        $printer->addModificationClass(TestModification::class);
        $printer->setLog($log);
        $this->assertEquals("This is bar!", trim($printer->print()));
    }

    public function testPrintEntry()
    {
        $entry = (new Entry())->addLine((new Line())->setText("This is foo!"));

        $printer = new ModifiableDefaultPrinter();
        $printer->addModificationClass(TestModification::class);
        $printer->setEntry($entry);
        $this->assertEquals("This is bar!", trim($printer->print()));
    }
}
