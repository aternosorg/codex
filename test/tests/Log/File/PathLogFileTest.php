<?php

namespace Aternos\Codex\Test\Tests\Log\File;

use Aternos\Codex\Log\File\PathLogFile;
use PHPUnit\Framework\TestCase;

class PathLogFileTest extends TestCase
{
    public function testGetContent(): void
    {
        $path = __DIR__ . "/../../../data/simple.log";
        $logFile = new PathLogFile($path);

        $this->assertEquals(file_get_contents($path), $logFile->getContent());
    }
}
