<?php

namespace Aternos\Codex\Test\Tests\Parser;

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\File\PathLogFile;
use Aternos\Codex\Log\Line;
use Aternos\Codex\Log\Log;
use PHPUnit\Framework\TestCase;

class DefaultParserTest extends TestCase
{
    /**
     * Get the log object expected from parsing data/simple.log
     *
     * @return Log
     */
    protected function getSimpleExpectedLog(): Log
    {
        return (new Log())
            ->setLogFile(new PathLogFile(__DIR__ . '/../../data/simple.log'))
            ->addEntry((new Entry())
                ->addLine(new Line(1, "[01.01.1970 00:00:01] [Log/INFO] This is the first message containing information.")))
            ->addEntry((new Entry())
                ->addLine(new Line(2, "[01.01.1970 00:00:02] [Log/DEBUG] This is the second message containing a debug information.")))
            ->addEntry((new Entry())
                ->addLine(new Line(3, "[01.01.1970 00:00:03] [Log/WARN] This is the third message containing a warning information.")))
            ->addEntry((new Entry())
                ->addLine(new Line(4, "[01.01.1970 00:00:04] [Log/ERROR] This is the third message containing an error information.")))
            ->addEntry((new Entry())
                ->addLine(new Line(5, "This line continues the error entry to add even more information.")))
            ->addEntry((new Entry())
                ->addLine(new Line(6, "This line is also part of the error entry.")))
            ->addEntry((new Entry())
                ->addLine(new Line(7, "[01.01.1970 00:00:05] [Log/INFO] This is the last message of the log.")));
    }


    public function testParse(): void
    {
        $logFile = new PathLogFile(__DIR__ . '/../../data/simple.log');
        $log = (new Log())->setLogFile($logFile);
        $log->parse();

        $this->assertEquals($this->getSimpleExpectedLog(), $log);
    }
}
