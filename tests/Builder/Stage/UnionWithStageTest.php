<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Stage;

use MongoDB\Builder\Accumulator;
use MongoDB\Builder\Expression;
use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

use function array_map;
use function array_merge;
use function MongoDB\object;
use function range;

/**
 * Test $unionWith stage
 */
class UnionWithStageTest extends PipelineTestCase
{
    public function testReport1AllSalesByYearAndStoresAndItems(): void
    {
        $pipeline = new Pipeline(...array_merge(
            [
                Stage::set(
                    _id: '2017',
                ),
            ],
            array_map(
                fn ($year) => Stage::unionWith(
                    coll: 'sales_' . $year,
                    pipeline: new Pipeline(
                        Stage::set(
                            _id: (string) $year,
                        ),
                    ),
                ),
                range(2018, 2020),
            ),
            [
                Stage::sort(
                    object(
                        _id: 1,
                        store: 1,
                        item: 1,
                    ),
                ),
            ],
        ));

        $this->assertSamePipeline(Pipelines::UnionWithReport1AllSalesByYearAndStoresAndItems, $pipeline);
    }

    public function testReport2AggregatedSalesByItems(): void
    {
        $pipeline = new Pipeline(
            Stage::unionWith('sales_2018'),
            Stage::unionWith('sales_2019'),
            Stage::unionWith('sales_2020'),
            Stage::group(
                _id: Expression::stringFieldPath('item'),
                total: Accumulator::sum(
                    Expression::numberFieldPath('quantity'),
                ),
            ),
            Stage::sort(
                object(
                    total: -1,
                ),
            ),
        );

        $this->assertSamePipeline(Pipelines::UnionWithReport2AggregatedSalesByItems, $pipeline);
    }
}
