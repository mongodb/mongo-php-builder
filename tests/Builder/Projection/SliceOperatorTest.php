<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Projection;

use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Projection;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

/**
 * Test $slice projection
 */
class SliceOperatorTest extends PipelineTestCase
{
    public function testReturnAnArrayWith3ElementsAfterSkippingTheFirstElement(): void
    {
        $pipeline = new Pipeline(
            Stage::project(
                comments: Projection::slice(1, 3),
            ),
        );

        $this->assertSamePipeline(Pipelines::SliceReturnAnArrayWith3ElementsAfterSkippingTheFirstElement, $pipeline);
    }

    public function testReturnAnArrayWith3ElementsAfterSkippingTheLastElement(): void
    {
        $pipeline = new Pipeline(
            Stage::project(
                comments: Projection::slice(-1, 3),
            ),
        );

        $this->assertSamePipeline(Pipelines::SliceReturnAnArrayWith3ElementsAfterSkippingTheLastElement, $pipeline);
    }

    public function testReturnAnArrayWithItsFirst3Elements(): void
    {
        $pipeline = new Pipeline(
            Stage::project(
                comments: Projection::slice(3),
            ),
        );

        $this->assertSamePipeline(Pipelines::SliceReturnAnArrayWithItsFirst3Elements, $pipeline);
    }

    public function testReturnAnArrayWithItsLast3Elements(): void
    {
        $pipeline = new Pipeline(
            Stage::project(
                comments: Projection::slice(-3),
            ),
        );

        $this->assertSamePipeline(Pipelines::SliceReturnAnArrayWithItsLast3Elements, $pipeline);
    }
}
