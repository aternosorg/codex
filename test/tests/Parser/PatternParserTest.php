<?php

require_once __DIR__ . '/../../src/Log/PatternLog.php';

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\File\PathLogFile;
use Aternos\Codex\Log\Line;
use Aternos\Codex\Log\Log;
use PHPUnit\Framework\TestCase;

class PatternParserTest extends TestCase
{
    /**
     * Get the log object expected from parsing data/simple.log
     *
     * @return Log
     */
    protected function getSimpleExpectedLog()
    {
        return (new PatternLog())
            ->setLogFile(new PathLogFile(__DIR__ . '/../../data/simple.log'))
            ->addEntry((new Entry())->setLevel("INFO")->setTime(1)
                ->addLine((new Line())->setNumber(1)->setText("[01.01.1970 00:00:01] [Log/INFO] This is the first message containing information.")))
            ->addEntry((new Entry())->setLevel("DEBUG")->setTime(2)
                ->addLine((new Line())->setNumber(2)->setText("[01.01.1970 00:00:02] [Log/DEBUG] This is the second message containing a debug information.")))
            ->addEntry((new Entry())->setLevel("WARN")->setTime(3)
                ->addLine((new Line())->setNumber(3)->setText("[01.01.1970 00:00:03] [Log/WARN] This is the third message containing a warning information.")))
            ->addEntry((new Entry())->setLevel("ERROR")->setTime(4)
                ->addLine((new Line())->setNumber(4)->setText("[01.01.1970 00:00:04] [Log/ERROR] This is the third message containing an error information."))
                ->addLine((new Line())->setNumber(5)->setText("This line continues the error entry to add even more information."))
                ->addLine((new Line())->setNumber(6)->setText("This line is also part of the error entry.")))
            ->addEntry((new Entry())->setLevel("INFO")->setTime(5)
                ->addLine((new Line())->setNumber(7)->setText("[01.01.1970 00:00:05] [Log/INFO] This is the last message of the log.")));
    }


    public function testParse()
    {
        $logFile = new PathLogFile(__DIR__ . '/../../data/simple.log');
        $log = (new PatternLog())->setLogFile($logFile);
        $log->parse();

        $this->assertEquals($this->getSimpleExpectedLog(), $log);
    }
}
