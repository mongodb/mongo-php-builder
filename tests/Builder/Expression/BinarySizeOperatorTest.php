<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Expression;

use MongoDB\Builder\Expression;
use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

/**
 * Test $binarySize expression
 */
class BinarySizeOperatorTest extends PipelineTestCase
{
    public function testExample(): void
    {
        $pipeline = new Pipeline(
            Stage::project(
                name: Expression::stringFieldPath('name'),
                imageSize: Expression::binarySize(
                    Expression::binDataFieldPath('binary'),
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::BinarySizeExample, $pipeline);
    }
}
