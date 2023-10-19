<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Accumulator;

use MongoDB\BSON\Javascript;
use MongoDB\Builder\Accumulator;
use MongoDB\Builder\Expression;
use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

use function MongoDB\object;

class AccumulatorAccumulatorTest extends PipelineTestCase
{
    /**
     * THIS METHOD IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
     *
     * @see testUseAccumulatorToImplementTheAvgOperator
     */
    public function getExpectedUseAccumulatorToImplementTheAvgOperator(): string
    {
        return <<<'JSON'
        [
            {
                "$group": {
                    "_id": "$author",
                    "avgCopies": {
                        "$accumulator": {
                            "init": {
                                "$code": "function () { return { count: 0, sum: 0 } }"
                            },
                            "accumulate": {
                                "$code": "function (state, numCopies) { return { count: state.count + 1, sum: state.sum + numCopies } }"
                            },
                            "accumulateArgs": [
                                "$copies"
                            ],
                            "merge": {
                                "$code": "function (state1, state2) { return { count: state1.count + state2.count, sum: state1.sum + state2.sum } }"
                            },
                            "finalize": {
                                "$code": "function (state) { return (state.sum \/ state.count) }"
                            },
                            "lang": "js"
                        }
                    }
                }
            }
        ]
        JSON;
    }

    /**
     * THIS METHOD IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
     *
     * @see testUseInitArgsToVaryTheInitialStateByGroup
     */
    public function getExpectedUseInitArgsToVaryTheInitialStateByGroup(): string
    {
        return <<<'JSON'
        [
            {
                "$group": {
                    "_id": {
                        "city": "$city"
                    },
                    "restaurants": {
                        "$accumulator": {
                            "init": {
                                "$code": "function (city, userProfileCity) { return { max: city === userProfileCity ? 3 : 1, restaurants: [] } }"
                            },
                            "initArgs": [
                                "$city",
                                "Bettles"
                            ],
                            "accumulate": {
                                "$code": "function (state, restaurantName) { if (state.restaurants.length < state.max) { state.restaurants.push(restaurantName); } return state; }"
                            },
                            "accumulateArgs": [
                                "$name"
                            ],
                            "merge": {
                                "$code": "function (state1, state2) { return { max: state1.max, restaurants: state1.restaurants.concat(state2.restaurants).slice(0, state1.max) } }"
                            },
                            "finalize": {
                                "$code": "function (state) { return state.restaurants }"
                            },
                            "lang": "js"
                        }
                    }
                }
            }
        ]
        JSON;
    }

    /** @see getExpectedUseAccumulatorToImplementTheAvgOperator */
    public function testUseAccumulatorToImplementTheAvgOperator(): void
    {
        $pipeline = new Pipeline(
            Stage::group(
                _id: Expression::fieldPath('author'),
                avgCopies: Accumulator::accumulator(
                    init: new Javascript('function () { return { count: 0, sum: 0 } }'),
                    accumulate: new Javascript('function (state, numCopies) { return { count: state.count + 1, sum: state.sum + numCopies } }'),
                    accumulateArgs: [Expression::fieldPath('copies')],
                    merge: new Javascript('function (state1, state2) { return { count: state1.count + state2.count, sum: state1.sum + state2.sum } }'),
                    finalize: new Javascript('function (state) { return (state.sum / state.count) }'),
                    lang: 'js',
                ),
            ),
        );

        $expected = $this->getExpectedUseAccumulatorToImplementTheAvgOperator();

        $this->assertSamePipeline($expected, $pipeline);
    }

    /** @see getExpectedUseInitArgsToVaryTheInitialStateByGroup */
    public function testUseInitArgsToVaryTheInitialStateByGroup(): void
    {
        $pipeline = new Pipeline(
            Stage::group(
                _id: object(city: Expression::fieldPath('city')),
                restaurants: Accumulator::accumulator(
                    init: new Javascript('function (city, userProfileCity) { return { max: city === userProfileCity ? 3 : 1, restaurants: [] } }'),
                    initArgs: [
                        Expression::fieldPath('city'),
                        'Bettles',
                    ],
                    accumulate: new Javascript('function (state, restaurantName) { if (state.restaurants.length < state.max) { state.restaurants.push(restaurantName); } return state; }'),
                    accumulateArgs: [Expression::fieldPath('name')],
                    merge: new Javascript('function (state1, state2) { return { max: state1.max, restaurants: state1.restaurants.concat(state2.restaurants).slice(0, state1.max) } }'),
                    finalize: new Javascript('function (state) { return state.restaurants }'),
                    lang: 'js',
                ),
            ),
        );

        $expected = $this->getExpectedUseInitArgsToVaryTheInitialStateByGroup();

        $this->assertSamePipeline($expected, $pipeline);
    }
}
