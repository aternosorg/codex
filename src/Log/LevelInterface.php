<?php

namespace Aternos\Codex\Log;

use JsonSerializable;

interface LevelInterface extends JsonSerializable
{
    /**
     * @param string $level
     * @return LevelInterface
     */
    public static function fromString(string $level): LevelInterface;

    /**
     * @return string
     */
    public function asString(): string;
}