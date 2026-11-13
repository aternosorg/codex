<?php

namespace Aternos\Codex\Test\Benchmarks;

use Random\Engine\Mt19937;
use Random\Randomizer;

/**
 * Generates large logs in the format of test/data/problem.log for the benchmarks
 *
 * The output only depends on the arguments, so every run and every branch measures the same log.
 */
class LogGenerator
{
    protected const int SEED = 1337;
    protected const int STACK_TRACE_LINES = 10;
    protected const array LEVELS = ["INFO", "INFO", "INFO", "WARN", "ERROR"];

    /**
     * @param int $entryCount Number of entries, every entry starts with a "[time] [Thread/LEVEL]" prefix
     * @param float $multiLineShare Share of entries followed by a stack trace, between 0 and 1
     * @param float $matchShare Share of entries that match one of the KeywordProblem patterns, between 0 and 1
     * @param int $keywordCount Number of different keywords used in matching entries, see KeywordProblems.php
     * @return string
     */
    public function generate(int $entryCount, float $multiLineShare = 0.1, float $matchShare = 0.05, int $keywordCount = 20): string
    {
        $randomizer = new Randomizer(new Mt19937(static::SEED));
        $lines = [];

        for ($entryIndex = 0; $entryIndex < $entryCount; $entryIndex++) {
            $time = gmdate("d.m.Y H:i:s", $entryIndex);
            $level = static::LEVELS[$randomizer->getInt(0, count(static::LEVELS) - 1)];
            $lines[] = "[" . $time . "] [Server/" . $level . "] " . $this->generateMessage($randomizer, $matchShare, $keywordCount);

            if ($randomizer->getFloat(0, 1) < $multiLineShare) {
                array_push($lines, ...$this->generateStackTrace($randomizer));
            }
        }

        return implode("\n", $lines);
    }

    /**
     * @param Randomizer $randomizer
     * @param float $matchShare
     * @param int $keywordCount
     * @return string
     */
    protected function generateMessage(Randomizer $randomizer, float $matchShare, int $keywordCount): string
    {
        if ($randomizer->getFloat(0, 1) < $matchShare) {
            $keyword = sprintf("Keyword%02d", $randomizer->getInt(1, $keywordCount));
            return $keyword . " failed with code " . $randomizer->getInt(1, 999);
        }

        return "Processed request " . $randomizer->getInt(1, 1_000_000) . " for client " . bin2hex($randomizer->getBytes(4));
    }

    /**
     * @param Randomizer $randomizer
     * @return string[]
     */
    protected function generateStackTrace(Randomizer $randomizer): array
    {
        $lines = ["java.lang.IllegalStateException: Unexpected state " . $randomizer->getInt(1, 100)];
        for ($frame = 0; $frame < static::STACK_TRACE_LINES; $frame++) {
            $lines[] = "\tat net.example.server.Worker" . $frame . ".run(Worker" . $frame . ".java:" . $randomizer->getInt(1, 500) . ")";
        }
        return $lines;
    }
}
