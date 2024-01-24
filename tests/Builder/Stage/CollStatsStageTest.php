<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Stage;

use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

use function MongoDB\object;

/**
 * Test $collStats stage
 */
class CollStatsStageTest extends PipelineTestCase
{
    public function testCountField(): void
    {
        $pipeline = new Pipeline(
            Stage::collStats(
                object(
                    count: object(),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::CollStatsCountField, $pipeline);
    }

    public function testLatencyStatsDocument(): void
    {
        $pipeline = new Pipeline(
            Stage::collStats(
                object(
                    latencyStats: object(
                        histograms: true,
                    ),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::CollStatsLatencyStatsDocument, $pipeline);
    }

    public function testQueryExecStatsDocument(): void
    {
        $pipeline = new Pipeline(
            Stage::collStats(
                object(
                    queryExecStats: object(),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::CollStatsQueryExecStatsDocument, $pipeline);
    }

    public function testStorageStatsDocument(): void
    {
        $pipeline = new Pipeline(
            Stage::collStats(
                object(
                    storageStats: object(),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::CollStatsStorageStatsDocument, $pipeline);
    }
}
