<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Type;

use Generator;
use MongoDB\BSON\Serializable;
use MongoDB\Builder\Query\EqOperator;
use MongoDB\Builder\Query\GtOperator;
use MongoDB\Builder\Type\CombinedFieldQuery;
use MongoDB\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CombinedFieldQueryTest extends TestCase
{
    public function testEmptyFieldQueries(): void
    {
        $fieldQueries = new CombinedFieldQuery([]);

        $this->assertSame([], $fieldQueries->fieldQueries);
    }

    public function testFieldQueries(): void
    {
        $fieldQueries = new CombinedFieldQuery([
            new EqOperator(1),
            ['$gt' => 1],
            (object) ['$lt' => 1],
            new class implements Serializable {
                public function bsonSerialize(): array
                {
                    return ['$gte' => 1];
                }
            },
        ]);

        $this->assertCount(4, $fieldQueries->fieldQueries);
    }

    public function testFlattenCombinedFieldQueries(): void
    {
        $fieldQueries = new CombinedFieldQuery([
            new CombinedFieldQuery([
                new CombinedFieldQuery([
                    ['$lt' => 1],
                    new CombinedFieldQuery([]),
                ]),
                ['$gt' => 1],
            ]),
            ['$gte' => 1],
        ]);

        $this->assertCount(3, $fieldQueries->fieldQueries);
    }

    /** @dataProvider provideInvalidFieldQuery */
    public function testRejectInvalidFieldQueries($invalidQuery): void
    {
        $this->expectException(InvalidArgumentException::class);

        new CombinedFieldQuery([$invalidQuery]);
    }

    public static function provideInvalidFieldQuery(): Generator
    {
        yield 'int' => [1];
        yield 'float' => [1.1];
        yield 'string' => ['foo'];
        yield 'bool' => [true];
        yield 'null' => [null];
        yield 'empy array' => [[]];
        yield 'empy object' => [(object) []];
        yield 'not operator array' => [['eq' => 1]];
        yield 'not operator object' => [(object) ['eq' => 1]];
    }

    /**
     * @param array<mixed> $fieldQueries
     *
     * @dataProvider provideDuplicateOperator
     */
    public function testRejectDuplicateOperator(array $fieldQueries): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Duplicate operator "$eq" detected.');

        new CombinedFieldQuery([
            ['$eq' => 1],
            new EqOperator(2),
        ]);
    }

    public function provideDuplicateOperator(): Generator
    {
        yield 'array and FieldQuery' => [
            [
                ['$eq' => 1],
                new EqOperator(2),
            ],
        ];

        yield 'object and FieldQuery' => [
            [
                (object) ['$gt' => 1],
                new GtOperator(2),
            ],
        ];

        yield 'object and array' => [
            [
                (object) ['$ne' => 1],
                ['$ne' => 2],
            ],
        ];
    }
}
