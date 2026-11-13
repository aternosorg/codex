<?php

namespace Aternos\Codex\Test\Benchmarks;

use Aternos\Codex\Analyser\PatternAnalyser;
use Aternos\Codex\Log\File\StringLogFile;
use Aternos\Codex\Test\Benchmarks\Insight\KeywordProblem;
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
class AnalyseBench
{
    protected TestPatternLog $log;
    protected PatternAnalyser $analyser;

    /**
     * Parse the log and set up the analyser outside of the measured time
     *
     * @param array{entries: int, multiLineShare: float, insightClasses: int} $params
     */
    public function setUp(array $params): void
    {
        $content = new LogGenerator()->generate($params["entries"], $params["multiLineShare"], keywordCount: $params["insightClasses"]);
        $this->log = new TestPatternLog()->setLogFile(new StringLogFile($content));
        $this->log->parse();

        $this->analyser = new PatternAnalyser();
        for ($index = 1; $index <= $params["insightClasses"]; $index++) {
            /** @var class-string<KeywordProblem> $insightClass */
            $insightClass = sprintf("%s%02d", KeywordProblem::class, $index);
            $this->analyser->addPossibleInsightClass($insightClass);
        }
        $this->analyser->setLog($this->log);
    }

    public function provideLogs(): Generator
    {
        yield "1k entries, 2 insights" => ["entries" => 1_000, "multiLineShare" => 0.1, "insightClasses" => 2];
        yield "1k entries, 20 insights" => ["entries" => 1_000, "multiLineShare" => 0.1, "insightClasses" => 20];
        yield "10k entries, 20 insights" => ["entries" => 10_000, "multiLineShare" => 0.1, "insightClasses" => 20];
        yield "10k entries, 20 insights, many stack traces" => ["entries" => 10_000, "multiLineShare" => 0.5, "insightClasses" => 20];
    }

    /**
     * Analyse the parsed log with the PatternAnalyser directly
     *
     * AnalysableLog::analyse() caches its result, so it would only measure the first revolution.
     */
    #[ParamProviders("provideLogs")]
    #[Revs(3)]
    public function benchAnalyse(): void
    {
        $this->analyser->analyse();
    }
}
