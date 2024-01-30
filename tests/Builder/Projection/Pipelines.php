<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Projection;

enum Pipelines: string
{
    /**
     * Zipcode Search
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/projection/elemMatch/#zipcode-search
     */
    case ElemMatchZipcodeSearch = <<<'JSON'
    [
        {
            "$match": {
                "zipcode": "63109"
            }
        },
        {
            "$project": {
                "students": {
                    "$elemMatch": {
                        "school": {
                            "$numberInt": "102"
                        }
                    }
                }
            }
        }
    ]
    JSON;

    /**
     * with Multiple Fields
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/projection/elemMatch/#with-multiple-fields
     */
    case ElemMatchWithMultipleFields = <<<'JSON'
    [
        {
            "$match": {
                "zipcode": "63109"
            }
        },
        {
            "$project": {
                "students": {
                    "$elemMatch": {
                        "school": {
                            "$numberInt": "102"
                        },
                        "age": {
                            "$gt": {
                                "$numberInt": "10"
                            }
                        }
                    }
                }
            }
        }
    ]
    JSON;
}
