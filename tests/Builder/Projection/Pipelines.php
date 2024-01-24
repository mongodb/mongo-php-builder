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

    /**
     * Return an Array with Its First 3 Elements
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/projection/slice/#return-an-array-with-its-first-3-elements
     */
    case SliceReturnAnArrayWithItsFirst3Elements = <<<'JSON'
    [
        {
            "$project": {
                "comments": {
                    "$slice": [
                        {
                            "$numberInt": "3"
                        }
                    ]
                }
            }
        }
    ]
    JSON;

    /**
     * Return an Array with Its Last 3 Elements
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/projection/slice/#return-an-array-with-its-last-3-elements
     */
    case SliceReturnAnArrayWithItsLast3Elements = <<<'JSON'
    [
        {
            "$project": {
                "comments": {
                    "$slice": [
                        {
                            "$numberInt": "-3"
                        }
                    ]
                }
            }
        }
    ]
    JSON;

    /**
     * Return an Array with 3 Elements After Skipping the First Element
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/projection/slice/#return-an-array-with-3-elements-after-skipping-the-first-element
     */
    case SliceReturnAnArrayWith3ElementsAfterSkippingTheFirstElement = <<<'JSON'
    [
        {
            "$project": {
                "comments": {
                    "$slice": [
                        {
                            "$numberInt": "1"
                        },
                        {
                            "$numberInt": "3"
                        }
                    ]
                }
            }
        }
    ]
    JSON;

    /**
     * Return an Array with 3 Elements After Skipping the Last Element
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/projection/slice/#return-an-array-with-3-elements-after-skipping-the-last-element
     */
    case SliceReturnAnArrayWith3ElementsAfterSkippingTheLastElement = <<<'JSON'
    [
        {
            "$project": {
                "comments": {
                    "$slice": [
                        {
                            "$numberInt": "-1"
                        },
                        {
                            "$numberInt": "3"
                        }
                    ]
                }
            }
        }
    ]
    JSON;
}
