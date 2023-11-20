<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Expression;

enum Pipelines: string
{
    /** Use in $addFields Stage */
    case FirstUseInAddFieldsStage = <<<'JSON'
    [
        {
            "$addFields": {
                "firstItem": {
                    "$first": "$items"
                }
            }
        }
    ]
    JSON;

    /**
     * Example
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/firstN-array-element/#example
     */
    case FirstNExample = <<<'JSON'
    [
        {
            "$addFields": {
                "firstScores": {
                    "$firstN": {
                        "n": {
                            "$numberInt": "3"
                        },
                        "input": "$score"
                    }
                }
            }
        }
    ]
    JSON;

    /** Use in $addFields Stage */
    case LastUseInAddFieldsStage = <<<'JSON'
    [
        {
            "$addFields": {
                "lastItem": {
                    "$last": "$items"
                }
            }
        }
    ]
    JSON;

    /**
     * Example
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/lastN-array-element/#example
     */
    case LastNExample = <<<'JSON'
    [
        {
            "$addFields": {
                "lastScores": {
                    "$lastN": {
                        "n": {
                            "$numberInt": "3"
                        },
                        "input": "$score"
                    }
                }
            }
        }
    ]
    JSON;

    /**
     * Using $lastN as an Aggregation Expression
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/lastN/#using--lastn-as-an-aggregation-expression
     */
    case LastNUsingLastNAsAnAggregationExpression = <<<'JSON'
    [
        {
            "$documents": [
                {
                    "array": [
                        {
                            "$numberInt": "10"
                        },
                        {
                            "$numberInt": "20"
                        },
                        {
                            "$numberInt": "30"
                        },
                        {
                            "$numberInt": "40"
                        }
                    ]
                }
            ]
        },
        {
            "$project": {
                "lastThreeElements": {
                    "$lastN": {
                        "input": "$array",
                        "n": {
                            "$numberInt": "3"
                        }
                    }
                }
            }
        }
    ]
    JSON;

    /**
     * Example
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/switch/
     */
    case SwitchExample = <<<'JSON'
    [
        {
            "$project": {
                "name": {
                    "$numberInt": "1"
                },
                "summary": {
                    "$switch": {
                        "branches": [
                            {
                                "case": {
                                    "$gte": [
                                        {
                                            "$avg": [
                                                "$scores"
                                            ]
                                        },
                                        {
                                            "$numberInt": "90"
                                        }
                                    ]
                                },
                                "then": "Doing great!"
                            },
                            {
                                "case": {
                                    "$and": [
                                        {
                                            "$gte": [
                                                {
                                                    "$avg": [
                                                        "$scores"
                                                    ]
                                                },
                                                {
                                                    "$numberInt": "80"
                                                }
                                            ]
                                        },
                                        {
                                            "$lt": [
                                                {
                                                    "$avg": [
                                                        "$scores"
                                                    ]
                                                },
                                                {
                                                    "$numberInt": "90"
                                                }
                                            ]
                                        }
                                    ]
                                },
                                "then": "Doing pretty well."
                            },
                            {
                                "case": {
                                    "$lt": [
                                        {
                                            "$avg": [
                                                "$scores"
                                            ]
                                        },
                                        {
                                            "$numberInt": "80"
                                        }
                                    ]
                                },
                                "then": "Needs improvement."
                            }
                        ],
                        "default": "No scores found."
                    }
                }
            }
        }
    ]
    JSON;
}
