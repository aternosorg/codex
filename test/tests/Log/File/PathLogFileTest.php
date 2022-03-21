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

        $this->assertStringEqualsFile($path, $logFile->getContent());
    }
}
