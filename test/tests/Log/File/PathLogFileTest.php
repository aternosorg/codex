<?php


use Aternos\Codex\Log\File\PathLogFile;
use PHPUnit\Framework\TestCase;

class PathLogFileTest extends TestCase
{
    public function testGetContent()
    {
        $path = __DIR__ . "/../../../data/simple.log";
        $logFile = new PathLogFile($path);

        $this->assertEquals(file_get_contents($path), $logFile->getContent());
    }
}
