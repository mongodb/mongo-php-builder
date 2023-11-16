<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Query;

use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Query;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

/**
 * Test $elemMatch query
 */
class ElemMatchOperatorTest extends PipelineTestCase
{
    public function testArrayOfEmbeddedDocuments(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                results: Query::elemMatch(
                    product: 'xyz',
                    score: Query::gte(8),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::ElemMatchArrayOfEmbeddedDocuments, $pipeline);
    }

    public function testElementMatch(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                results: Query::elemMatch(
                    Query::gte(80),
                    Query::lt(85),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::ElemMatchElementMatch, $pipeline);
    }

    public function testSingleQueryCondition(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                results: Query::elemMatch(
                    product: Query::ne('xyz'),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::ElemMatchSingleQueryCondition, $pipeline);
    }
}
