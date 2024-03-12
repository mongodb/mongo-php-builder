<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder;

use MongoDB\Builder\Query;
use MongoDB\Builder\Stage\FluentFactory;
use MongoDB\Builder\Type\Sort;

class FluentPipelineFactoryTest extends PipelineTestCase
{
    public function testFluentPipelineFactory(): void
    {
        $pipeline = (new FluentFactory())
            ->match(x: Query::eq(1))
            ->project(_id: false, x: true)
            ->sort(x: Sort::Asc)
            ->getPipeline();

        $expected = <<<'json'
        [
            {"$match": {"x": {"$eq": {"$numberInt":  "1"}}}},
            {"$project": {"_id": false, "x": true}},
            {"$sort": {"x": {"$numberInt":  "1"}}}
        ]
        json;

        $this->assertSamePipeline($expected, $pipeline);
    }
}
