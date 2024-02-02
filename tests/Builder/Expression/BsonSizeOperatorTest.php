<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Expression;

use MongoDB\Builder\Accumulator;
use MongoDB\Builder\Expression;
use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Builder\Type\Sort;
use MongoDB\Builder\Type\Variable;
use MongoDB\Tests\Builder\PipelineTestCase;

/**
 * Test $bsonSize expression
 */
class BsonSizeOperatorTest extends PipelineTestCase
{
    public function testReturnCombinedSizeOfAllDocumentsInACollection(): void
    {
        $pipeline = new Pipeline(
            Stage::group(
                _id: null,
                combined_object_size: Accumulator::sum(
                    Expression::bsonSize(
                        Variable::Root,
                    ),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::BsonSizeReturnCombinedSizeOfAllDocumentsInACollection, $pipeline);
    }

    public function testReturnDocumentWithLargestSpecifiedField(): void
    {
        $pipeline = new Pipeline(
            Stage::project(
                name: Expression::stringFieldPath('name'),
                task_object_size: Expression::bsonSize(
                    Expression::objectFieldPath('current_task'),
                ),
            ),
            Stage::sort(
                task_object_size: Sort::Desc,
            ),
            Stage::limit(1),
        );

        $this->assertSamePipeline(Pipelines::BsonSizeReturnDocumentWithLargestSpecifiedField, $pipeline);
    }

    public function testReturnSizesOfDocuments(): void
    {
        $pipeline = new Pipeline(
            Stage::project(
                name: 1,
                object_size: Expression::bsonSize(
                    Variable::Root,
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::BsonSizeReturnSizesOfDocuments, $pipeline);
    }
}
