<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Query;

use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Query;
use MongoDB\Builder\QueryType;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

/**
 * Test $type query
 */
class TypeOperatorTest extends PipelineTestCase
{
    public function testQueryingByArrayType(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                zipCode: Query::type('array'),
            ),
        );

        $this->assertSamePipeline(Pipelines::TypeQueryingByArrayType, $pipeline);
    }

    public function testQueryingByDataType(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                zipCode: Query::type(2),
            ),
            Stage::match(
                zipCode: QueryType::String,
            ),
            Stage::match(
                zipCode: Query::type(1),
            ),
            Stage::match(
                zipCode: Query::type(QueryType::Double),
            ),
            Stage::match(
                zipCode: QueryType::Number,
            ),
        );

        $this->assertSamePipeline(Pipelines::TypeQueryingByDataType, $pipeline);
    }

    public function testQueryingByMinKeyAndMaxKey(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                zipCode: Query::type('minKey'),
            ),
            Stage::match(
                zipCode: Query::type('maxKey'),
            ),
        );

        $this->assertSamePipeline(Pipelines::TypeQueryingByMinKeyAndMaxKey, $pipeline);
    }

    public function testQueryingByMultipleDataType(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                zipCode: Query::type(2, 1),
            ),
            Stage::match(
                zipCode: Query::type(QueryType::String, 'double'),
            ),
        );

        $this->assertSamePipeline(Pipelines::TypeQueryingByMultipleDataType, $pipeline);
    }
}
