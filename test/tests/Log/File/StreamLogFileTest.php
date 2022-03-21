<?php

namespace Aternos\Codex\Test\Tests\Log\File;

use Aternos\Codex\Log\File\StreamLogFile;
use PHPUnit\Framework\TestCase;

class StreamLogFileTest extends TestCase
{
    public function testGetContent()
    {
        $path = __DIR__ . "/../../../data/simple.log";
        $streamResource = fopen($path, 'r');

        $logFile = new StreamLogFile($streamResource);
        $this->assertEquals(file_get_contents($path), $logFile->getContent());
    }
}
