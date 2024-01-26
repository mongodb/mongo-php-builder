<?php

declare(strict_types=1);

namespace MongoDB\Builder;

use ArrayIterator;
use IteratorAggregate;
use MongoDB\Builder\Type\StageInterface;
use MongoDB\Exception\InvalidArgumentException;

use function array_is_list;
use function array_merge;
use function is_array;

/**
 * An aggregation pipeline consists of one or more stages that process documents.
 *
 * @see https://www.mongodb.com/docs/manual/core/aggregation-pipeline/
 *
 * @psalm-immutable
 * @implements IteratorAggregate<StageInterface|array<string,mixed>|object>
 */
final class Pipeline implements IteratorAggregate
{
    private readonly array $stages;

    /**
     * @param StageInterface|Pipeline|list<StageInterface> ...$stagesOrPipelines
     *
     * @no-named-arguments
     */
    public function __construct(StageInterface|Pipeline|array ...$stagesOrPipelines)
    {
        if (! array_is_list($stagesOrPipelines)) {
            throw new InvalidArgumentException('Named arguments are not supported for pipelines');
        }

        $stages = [];

        foreach ($stagesOrPipelines as $stageOrPipeline) {
            if (is_array($stageOrPipeline) && array_is_list($stageOrPipeline)) {
                $stages = array_merge($stages, $stageOrPipeline);
            } elseif ($stageOrPipeline instanceof Pipeline) {
                $stages = array_merge($stages, $stageOrPipeline->stages);
            } else {
                $stages[] = $stageOrPipeline;
            }
        }

        $this->stages = $stages;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->stages);
    }
}
