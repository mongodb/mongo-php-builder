<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Stage;

final class Pipelines
{
    /** @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/addFields/#using-two--addfields-stages */
    public const ADDFIELDS_USING_TWO_ADDFIELDS_STAGES = <<<'JSON'
    [
        {
            "$addFields": {
                "totalHomework": {
                    "$sum": "$homework"
                },
                "totalQuiz": {
                    "$sum": "$quiz"
                }
            }
        },
        {
            "$addFields": {
                "totalScore": {
                    "$add": [
                        "$totalHomework",
                        "$totalQuiz",
                        "$extraCredit"
                    ]
                }
            }
        }
    ]
    JSON;

    /** @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/addFields/#adding-fields-to-an-embedded-document */
    public const ADDFIELDS_ADDING_FIELDS_TO_AN_EMBEDDED_DOCUMENT = <<<'JSON'
    [
        {
            "$addFields": {
                "specs.fuel_type": "unleaded"
            }
        }
    ]
    JSON;
}
