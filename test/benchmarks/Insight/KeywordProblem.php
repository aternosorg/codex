<?php

namespace Aternos\Codex\Test\Benchmarks\Insight;

use Aternos\Codex\Analysis\InsightInterface;
use Aternos\Codex\Analysis\PatternInsightInterface;
use Aternos\Codex\Analysis\Problem;

/**
 * A problem that matches lines like "Keyword07 failed with code 42"
 *
 * Real users of codex register dozens of insight classes, each with its own patterns.
 * The subclasses in KeywordProblems.php only differ in their keyword, so the benchmarks
 * can analyse a log with any number of distinct insight classes.
 */
abstract class KeywordProblem extends Problem implements PatternInsightInterface
{
    protected ?string $code = null;

    /**
     * @return string The keyword this problem looks for, e.g. "Keyword07"
     */
    abstract public static function getKeyword(): string;

    /**
     * @inheritDoc
     */
    public static function getPatterns(): array
    {
        // Built from fragments on every call like many real insight classes do,
        // e.g. "/Keyword07 failed with code (?<code>\d+)/" matches "Keyword07 failed with code 42"
        return ['/' . preg_quote(static::getKeyword(), '/') . ' failed with code (?<code>\d+)/'];
    }

    /**
     * @inheritDoc
     */
    public function setMatches(array $matches, mixed $patternKey): void
    {
        $this->code = $matches['code'];
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {
        return static::getKeyword() . " failed with code " . $this->code;
    }

    /**
     * @inheritDoc
     */
    public function isEqual(InsightInterface $insight): bool
    {
        return $insight instanceof static && $this->code === $insight->code;
    }
}
