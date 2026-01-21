<?php

namespace Aternos\Codex\Test\Tests\Parser;

use Aternos\Codex\Log\Entry;
use Aternos\Codex\Log\File\PathLogFile;
use Aternos\Codex\Log\Level;
use Aternos\Codex\Log\Line;
use Aternos\Codex\Log\Log;
use Aternos\Codex\Parser\PatternParser;
use Aternos\Codex\Test\Src\Log\TestPatternLog;
use PHPUnit\Framework\TestCase;

class PatternParserTest extends TestCase
{
    /**
     * Get the log object expected from parsing data/simple.log
     *
     * @return Log
     */
    protected function getSimpleExpectedLog(): Log
    {
        return (new TestPatternLog())
            ->setLogFile(new PathLogFile(__DIR__ . '/../../data/simple.log'))
            ->addEntry((new Entry())->setLevel(Level::INFO)->setTime(1)->setPrefix("[01.01.1970 00:00:01] [Log/INFO]")
                ->addLine(new Line(1, "[01.01.1970 00:00:01] [Log/INFO] This is the first message containing information.")))
            ->addEntry((new Entry())->setLevel(Level::DEBUG)->setTime(2)->setPrefix("[01.01.1970 00:00:02] [Log/DEBUG]")
                ->addLine(new Line(2, "[01.01.1970 00:00:02] [Log/DEBUG] This is the second message containing a debug information.")))
            ->addEntry((new Entry())->setLevel(Level::WARNING)->setTime(3)->setPrefix("[01.01.1970 00:00:03] [Log/WARN]")
                ->addLine(new Line(3, "[01.01.1970 00:00:03] [Log/WARN] This is the third message containing a warning information.")))
            ->addEntry((new Entry())->setLevel(Level::ERROR)->setTime(4)->setPrefix("[01.01.1970 00:00:04] [Log/ERROR]")
                ->addLine(new Line(4, "[01.01.1970 00:00:04] [Log/ERROR] This is the third message containing an error information."))
                ->addLine(new Line(5, "This line continues the error entry to add even more information."))
                ->addLine(new Line(6, "This line is also part of the error entry.")))
            ->addEntry((new Entry())->setLevel(Level::INFO)->setTime(5)->setPrefix("[01.01.1970 00:00:05] [Log/INFO]")
                ->addLine(new Line(7, "[01.01.1970 00:00:05] [Log/INFO] This is the last message of the log.")));
    }


    public function testParse(): void
    {
        $logFile = new PathLogFile(__DIR__ . '/../../data/simple.log');
        $log = (new TestPatternLog())->setLogFile($logFile);
        $log->parse();

        $this->assertEquals($this->getSimpleExpectedLog(), $log);
    }

    public function testParseWithCustomParser(): void
    {
        $logFile = new PathLogFile(__DIR__ . '/../../data/simple.log');
        $log = (new TestPatternLog())->setLogFile($logFile);

        $patternParser = (new PatternParser())
            ->setPattern('/(\[([^\]]+)\] \[[^\/]+\/([^\]]+)\]).*/')
            ->setMatches([PatternParser::PREFIX, PatternParser::TIME, PatternParser::LEVEL])
            ->setTimeFormat('d.m.Y H:i:s');
        $log->parse($patternParser);

        $this->assertEquals($this->getSimpleExpectedLog(), $log);
    }

    public function testGetPattern(): void
    {
        $pattern = '/\[([^\]]+)\] \[[^\/]+\/([^\]]+)\].*/';

        $patternParser = (new PatternParser())
            ->setPattern($pattern)
            ->setMatches([PatternParser::TIME, PatternParser::LEVEL])
            ->setTimezone(new \DateTimeZone('Europe/Berlin'))
            ->setTimeFormat('d.m.Y H:i:s');

        $this->assertEquals($pattern, $patternParser->getPattern());
    }

}
