<?php

require_once __DIR__ . "/../../src/Printer/TestModification.php";

use Aternos\Codex\Log\File\StringLogFile;
use Aternos\Codex\Log\Log;
use Aternos\Codex\Printer\ModifiableDefaultPrinter;
use Aternos\Codex\Printer\PatternModification;
use PHPUnit\Framework\TestCase;

class PatternModificationTest extends TestCase
{
    public function testPrint()
    {
        $logFile = new StringLogFile("This is foo!");
        $log = new Log();
        $log->setLogFile($logFile);
        $log->parse();

        $printer = new ModifiableDefaultPrinter();
        $printer->addModification((new PatternModification())->setPattern('/foo/')->setReplacement('bar'));
        $printer->setLog($log);
        $this->assertEquals("This is bar!", trim($printer->print()));
    }
}
