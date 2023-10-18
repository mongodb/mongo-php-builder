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
     *
     * @return list<array<string, mixed>>
     */
    public function getExpectedUseAccumulatorToImplementTheAvgOperator(): array
    {
        return [(object) [
            '$group' => (object) [
                '_id' => '$author',
                'avgCopies' => (object) [
                    '$accumulator' => (object) [
                        'init' => new Javascript('function () { return {count: 0, sum: 0} }'),
                        'accumulate' => new Javascript('function (state, numCopies) { return { count: state.count + 1, sum: state.sum + numCopies } }'),
                        'accumulateArgs' => ['$copies'],
                        'merge' => new Javascript('function (state1, state2) { return { count: state1.count + state2.count, sum: state1.sum + state2.sum } }'),
                        'finalize' => new Javascript('function (state) { return (state.sum / state.count) }'),
                        'lang' => 'js',
                    ],
                ],
            ],
        ],
        ];
    }

    /**
     * THIS METHOD IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
     *
     * @see testUseInitArgsToVaryTheInitialStateByGroup
     *
     * @return list<array<string, mixed>>
     */
    public function getExpectedUseInitArgsToVaryTheInitialStateByGroup(): array
    {
        return [(object) [
            '$group' => (object) [
                '_id' => (object) ['city' => '$city'],
                'restaurants' => (object) [
                    '$accumulator' => (object) [
                        'init' => new Javascript('function (city, userProfileCity) { return { max: city === userProfileCity ? 3 : 1, restaurants: [] } }'),
                        'initArgs' => [
                            '$city',
                            'Bettles',
                        ],
                        'accumulate' => new Javascript('function (state, restaurantName) { if (state.restaurants.length < state.max) { state.restaurants.push(restaurantName); } return state; }'),
                        'accumulateArgs' => ['$name'],
                        'merge' => new Javascript('function (state1, state2) { return { max: state1.max, restaurants: state1.restaurants.concat(state2.restaurants).slice(0, state1.max) } }'),
                        'finalize' => new Javascript('function (state) { return state.restaurants }'),
                        'lang' => 'js',
                    ],
                ],
            ],
        ],
        ];
    }

    /** @see getExpectedUseAccumulatorToImplementTheAvgOperator */
    public function testUseAccumulatorToImplementTheAvgOperator(): void
    {
        $pipeline = new Pipeline(
            Stage::group(
                _id: Expression::fieldPath('author'),
                avgCopies: Accumulator::accumulator(
                    init: new Javascript('function () { return {count: 0, sum: 0} }'),
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
