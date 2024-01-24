<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Projection;

use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Projection;
use MongoDB\Builder\Query;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

/**
 * Test $elemMatch projection
 */
class ElemMatchOperatorTest extends PipelineTestCase
{
    public function testWithMultipleFields(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                zipcode: '63109',
            ),
            Stage::project(
                students: Projection::elemMatch(
                    Query::query(
                        school: 102,
                        age: Query::gt(10),
                    ),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::ElemMatchWithMultipleFields, $pipeline);
    }

    public function testZipcodeSearch(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                zipcode: '63109',
            ),
            Stage::project(
                students: Projection::elemMatch(
                    Query::query(
                        school: 102,
                    ),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::ElemMatchZipcodeSearch, $pipeline);
    }
}
