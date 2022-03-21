<?php

namespace Aternos\Codex\Test\Tests\Log\File;

use Aternos\Codex\Log\File\StringLogFile;
use PHPUnit\Framework\TestCase;

class StringLogFileTest extends TestCase
{
    public function testGetContent()
    {
        $content = uniqid();
        $logFile = new StringLogFile($content);

        $this->assertEquals($content, $logFile->getContent());
    }
}
