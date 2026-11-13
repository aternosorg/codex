<?php

namespace Aternos\Codex\Test\Benchmarks;

use Aternos\Codex\Log\File\StringLogFile;
use Aternos\Codex\Test\Src\Log\TestPatternLog;
use Generator;
use PhpBench\Attributes\BeforeMethods;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\ParamProviders;
use PhpBench\Attributes\Revs;
use PhpBench\Attributes\Warmup;

#[BeforeMethods("setUp")]
#[Iterations(5)]
#[Warmup(1)]
class ParseBench
{
    protected string $content;

    /**
     * @param array{entries: int, multiLineShare: float} $params
     */
    public function setUp(array $params): void
    {
        $this->content = new LogGenerator()->generate($params["entries"], $params["multiLineShare"]);
    }

    public function provideLogs(): Generator
    {
        yield "1k entries" => ["entries" => 1_000, "multiLineShare" => 0.1];
        yield "10k entries" => ["entries" => 10_000, "multiLineShare" => 0.1];
        yield "10k entries, many stack traces" => ["entries" => 10_000, "multiLineShare" => 0.5];
    }

    /**
     * Parse the log with the PatternParser of TestPatternLog
     *
     * A new log is created for every revolution because parsing adds entries to the log.
     */
    #[ParamProviders("provideLogs")]
    #[Revs(3)]
    public function benchParse(): void
    {
        new TestPatternLog()
            ->setLogFile(new StringLogFile($this->content))
            ->parse();
    }
}
