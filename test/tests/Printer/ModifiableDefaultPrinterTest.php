<?php

require_once __DIR__ . "/../../src/Printer/TestModification.php";

use Aternos\Codex\Log\File\StringLogFile;
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
}
