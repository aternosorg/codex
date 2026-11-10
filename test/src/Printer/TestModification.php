<?php

namespace Aternos\Codex\Test\Src\Printer;

use Aternos\Codex\Printer\Modification;

class TestModification extends Modification
{
    /**
     * Modify the given string and return it
     *
     * @param string $text
     * @return string
     */
    public function modify(string $text): string
    {
        return str_replace("foo", "bar", $text);
    }
}