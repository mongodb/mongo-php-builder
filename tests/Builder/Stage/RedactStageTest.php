<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Stage;

use MongoDB\Builder\Expression;
use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Builder\Type\Redact;
use MongoDB\Tests\Builder\PipelineTestCase;

/**
 * Test $redact stage
 */
class RedactStageTest extends PipelineTestCase
{
    public function testEvaluateAccessAtEveryDocumentLevel(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                year: 2014,
            ),
            Stage::redact(
                Expression::cond(
                    if: Expression::gt(
                        Expression::size(
                            Expression::setIntersection(
                                Expression::arrayFieldPath('tags'),
                                ['STLW', 'G'],
                            ),
                        ),
                        0,
                    ),
                    then: Redact::Descend,
                    else: Redact::Prune,
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::RedactEvaluateAccessAtEveryDocumentLevel, $pipeline);
    }

    public function testExcludeAllFieldsAtAGivenLevel(): void
    {
        $pipeline = new Pipeline(
            Stage::match(
                status: 'A',
            ),
            Stage::redact(
                Expression::cond(
                    if: Expression::eq(
                        Expression::intFieldPath('level'),
                        5,
                    ),
                    then: Redact::Prune,
                    else: Redact::Descend,
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::RedactExcludeAllFieldsAtAGivenLevel, $pipeline);
    }
}
