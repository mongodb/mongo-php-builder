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
     */
    public function getExpectedAddingFieldsToAnEmbeddedDocument(): string
    {
        return <<<'JSON'
        [
            {
                "$addFields": {
                    "specs.fuel_type": "unleaded"
                }
            }
        ]
        JSON;
    }

    /**
     * THIS METHOD IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
     *
     * @see testUsingTwoAddFieldsStages
     */
    public function getExpectedUsingTwoAddFieldsStages(): string
    {
        return <<<'JSON'
        [
            {
                "$addFields": {
                    "totalHomework": {
                        "$sum": "$homework"
                    },
                    "totalQuiz": {
                        "$sum": "$quiz"
                    }
                }
            },
            {
                "$addFields": {
                    "totalScore": {
                        "$add": [
                            "$totalHomework",
                            "$totalQuiz",
                            "$extraCredit"
                        ]
                    }
                }
            }
        ]
        JSON;
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

    /** @see getExpectedUsingTwoAddFieldsStages */
    public function testUsingTwoAddFieldsStages(): void
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
