<?php

namespace Aternos\Codex\Log;

enum Level: int
{
    case EMERGENCY = 0;
    case ALERT = 1;
    case CRITICAL = 2;
    case ERROR = 3;
    case WARNING = 4;
    case NOTICE = 5;
    case INFO = 6;
    case DEBUG = 7;

    public static function fromString(string $level): Level
    {
        return match (strtolower($level)) {
            "emergency" => Level::EMERGENCY,
            "alert" => Level::ALERT,
            "critical", "severe" => Level::CRITICAL,
            "error", "stderr", "stacktrace" => Level::ERROR,
            "warning", "warn" => Level::WARNING,
            "notice" => Level::NOTICE,
            "debug", "comment" => Level::DEBUG,
            default => Level::INFO
        };
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return match ($this) {
            Level::EMERGENCY => "emergency",
            Level::ALERT => "alert",
            Level::CRITICAL => "critical",
            Level::ERROR => "error",
            Level::WARNING => "warning",
            Level::NOTICE => "notice",
            Level::INFO => "info",
            Level::DEBUG => "debug"
        };
    }
}
