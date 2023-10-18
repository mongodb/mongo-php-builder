<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Stage;

use MongoDB\Builder\Expression;
use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

class AddFieldsStageTest extends PipelineTestCase
{
    /**
     * THIS METHOD IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
     *
     * @see testAddingFieldsToAnEmbeddedDocument
     *
     * @return list<array<string, mixed>>
     */
    public function getExpectedAddingFieldsToAnEmbeddedDocument(): array
    {
        return [(object) [
            '$addFields' => (object) ['specs.fuel_type' => 'unleaded'],
        ],
        ];
    }

    /**
     * THIS METHOD IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
     *
     * @see testUsingTwoAaddFieldsStages
     *
     * @return list<array<string, mixed>>
     */
    public function getExpectedUsingTwoAaddFieldsStages(): array
    {
        return [
            (object) [
                '$addFields' => (object) [
                    'totalHomework' => (object) ['$sum' => '$homework'],
                    'totalQuiz' => (object) ['$sum' => '$quiz'],
                ],
            ],
            (object) [
                '$addFields' => (object) [
                    'totalScore' => (object) [
                        '$add' => [
                            '$totalHomework',
                            '$totalQuiz',
                            '$extraCredit',
                        ],
                    ],
                ],
            ],
        ];
    }

    /** @see getExpectedAddingFieldsToAnEmbeddedDocument */
    public function testAddingFieldsToAnEmbeddedDocument(): void
    {
        $pipeline = new Pipeline(
            Stage::addFields(
                ...['specs.fuel_type' => 'unleaded'],
            ),
        );

        $expected = $this->getExpectedAddingFieldsToAnEmbeddedDocument();

        $this->assertSamePipeline($expected, $pipeline);
    }

    /** @see getExpectedUsingTwoAaddFieldsStages */
    public function testUsingTwoAaddFieldsStages(): void
    {
        $this->markTestSkipped('$sum must accept arrayFieldPath and render it as a single value: https://jira.mongodb.org/browse/PHPLIB-1287');

        $pipeline = new Pipeline(
            Stage::addFields(
                totalHomework: Expression::sum(Expression::fieldPath('homework')),
                totalQuiz: Expression::sum(Expression::fieldPath('quiz')),
            ),
            Stage::addFields(
                totalScore: Expression::add(
                    Expression::fieldPath('totalHomework'),
                    Expression::fieldPath('totalQuiz'),
                    Expression::fieldPath('extraCredit'),
                ),
            ),
        );

        $expected = $this->getExpectedUsingTwoAaddFieldsStages();

        $this->assertSamePipeline($expected, $pipeline);
    }
}
