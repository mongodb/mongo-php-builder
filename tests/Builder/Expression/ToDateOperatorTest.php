<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Expression;

use MongoDB\Builder\Expression;
use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

use function MongoDB\object;

/**
 * Test $toDate expression
 */
class ToDateOperatorTest extends PipelineTestCase
{
    public function testExample(): void
    {
        $pipeline = new Pipeline(
            Stage::addFields(
                convertedDate: Expression::toDate(
                    Expression::fieldPath('order_date'),
                ),
            ),
            Stage::sort(
                object(
                    convertedDate: 1,
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::ToDateExample, $pipeline);
    }
}
