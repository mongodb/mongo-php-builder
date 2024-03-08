<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder;

use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Query;
use MongoDB\Builder\Stage\FluentFactory;
use MongoDB\Builder\Type\Sort;
use PHPUnit\Framework\TestCase;

class FluentPipelineFactoryTest extends TestCase
{
    public function testFluentPipelineFactory(): void
    {
        $pipeline = (new FluentFactory())
            ->match(x: Query::eq(1))
            ->project(_id: false, x: true)
            ->sort(x: Sort::Asc)
            ->getPipeline();

        $this->assertInstanceof(Pipeline::class, $pipeline);
        $this->assertCount(3, $pipeline->getIterator());
    }
}
