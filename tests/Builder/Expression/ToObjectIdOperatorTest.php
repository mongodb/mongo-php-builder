<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Expression;

use MongoDB\Builder\Expression;
use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

use function MongoDB\object;

/**
 * Test $toObjectId expression
 */
class ToObjectIdOperatorTest extends PipelineTestCase
{
    public function testExample(): void
    {
        $pipeline = new Pipeline(
            Stage::addFields(
                convertedId: Expression::toObjectId(
                    Expression::fieldPath('_id'),
                ),
            ),
            Stage::sort(
                object(
                    convertedId: -1,
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::ToObjectIdExample, $pipeline);
    }
}
