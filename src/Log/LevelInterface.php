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

    /**
     * @return int
     */
    public function asInt(): int;

    /**
     * Returns true if the log level should be considered an error level.
     *
     * @return bool
     */
    public function isError(): bool;
}
