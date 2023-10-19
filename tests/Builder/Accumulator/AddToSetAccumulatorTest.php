<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Accumulator;

use MongoDB\Builder\Accumulator;
use MongoDB\Builder\Expression;
use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

use function MongoDB\object;

class AddToSetAccumulatorTest extends PipelineTestCase
{
    /**
     * THIS METHOD IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
     *
     * @see testUseInGroupStage
     */
    public function getExpectedUseInGroupStage(): string
    {
        return <<<'JSON'
        [
            {
                "$group": {
                    "_id": {
                        "day": {
                            "$dayOfYear": {
                                "date": "$date"
                            }
                        },
                        "year": {
                            "$year": {
                                "date": "$date"
                            }
                        }
                    },
                    "itemsSold": {
                        "$addToSet": "$item"
                    }
                }
            }
        ]
        JSON;
    }

    /**
     * THIS METHOD IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
     *
     * @see testUseInSetWindowFieldsStage
     */
    public function getExpectedUseInSetWindowFieldsStage(): string
    {
        return <<<'JSON'
        [
            {
                "$setWindowFields": {
                    "partitionBy": "$state",
                    "sortBy": {
                        "orderDate": 1
                    },
                    "output": {
                        "cakeTypesForState": {
                            "$addToSet": "$type",
                            "window": {
                                "documents": [
                                    "unbounded",
                                    "current"
                                ]
                            }
                        }
                    }
                }
            }
        ]
        JSON;
    }

    /** @see getExpectedUseInGroupStage */
    public function testUseInGroupStage(): void
    {
        $pipeline = new Pipeline(
            Stage::group(
                _id: object(
                    day: Expression::dayOfYear(Expression::dateFieldPath('date')),
                    year: Expression::year(Expression::dateFieldPath('date')),
                ),
                itemsSold: Accumulator::addToSet(Expression::arrayFieldPath('item')),
            ),
        );

        $expected = $this->getExpectedUseInGroupStage();

        $this->assertSamePipeline($expected, $pipeline);
    }

    /** @see getExpectedUseInSetWindowFieldsStage */
    public function testUseInSetWindowFieldsStage(): void
    {
        $pipeline = new Pipeline(
            Stage::setWindowFields(
                partitionBy: Expression::fieldPath('state'),
                sortBy: object(
                    orderDate: 1,
                ),
                output: object(
                    cakeTypesForState: Accumulator::outputWindow(
                        Accumulator::addToSet(Expression::fieldPath('type')),
                        documents: [
                            'unbounded',
                            'current',
                        ],
                    ),
                ),
            ),
        );

        $expected = $this->getExpectedUseInSetWindowFieldsStage();

        $this->assertSamePipeline($expected, $pipeline);
    }
}
