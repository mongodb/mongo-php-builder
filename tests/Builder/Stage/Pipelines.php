<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Stage;

enum Pipelines: string
{
    /**
     * Using Two $addFields Stages
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/addFields/#using-two--addfields-stages
     */
    case AddFieldsUsingTwoAddFieldsStages = <<<'JSON'
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

    /**
     * Adding Fields to an Embedded Document
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/addFields/#adding-fields-to-an-embedded-document
     */
    case AddFieldsAddingFieldsToAnEmbeddedDocument = <<<'JSON'
    [
        {
            "$addFields": {
                "specs.fuel_type": "unleaded"
            }
        }
    ]
    JSON;

    /**
     * Basic Example
     *
     * @see https://www.mongodb.com/docs/atlas/atlas-search/highlighting/#basic-example
     */
    case SearchBasicExample = <<<'JSON'
    [
        {
            "$search": {
                "text": {
                    "path": "description",
                    "query": [
                        "variety",
                        "bunch"
                    ]
                },
                "highlight": {
                    "path": "description"
                }
            }
        },
        {
            "$project": {
                "description": {
                    "$numberInt": "1"
                },
                "_id": {
                    "$numberInt": "0"
                },
                "highlights": {
                    "$meta": "searchHighlights"
                }
            }
        }
    ]
    JSON;

    /**
     * Advanced Example
     *
     * @see https://www.mongodb.com/docs/atlas/atlas-search/highlighting/#advanced-example
     */
    case SearchAdvancedExample = <<<'JSON'
    [
        {
            "$search": {
                "text": {
                    "path": "description",
                    "query": [
                        "variety",
                        "bunch"
                    ]
                },
                "highlight": {
                    "path": "description",
                    "maxNumPassages": {
                        "$numberInt": "1"
                    },
                    "maxCharsToExamine": {
                        "$numberInt": "40"
                    }
                }
            }
        },
        {
            "$project": {
                "description": {
                    "$numberInt": "1"
                },
                "_id": {
                    "$numberInt": "0"
                },
                "highlights": {
                    "$meta": "searchHighlights"
                }
            }
        }
    ]
    JSON;

    /**
     * Multi-Field Example
     *
     * @see https://www.mongodb.com/docs/atlas/atlas-search/highlighting/#multi-field-example
     */
    case SearchMultiFieldExample = <<<'JSON'
    [
        {
            "$search": {
                "text": {
                    "path": "description",
                    "query": "varieties"
                },
                "highlight": {
                    "path": [
                        "description",
                        "summary"
                    ]
                }
            }
        },
        {
            "$project": {
                "description": {
                    "$numberInt": "1"
                },
                "summary": {
                    "$numberInt": "1"
                },
                "_id": {
                    "$numberInt": "0"
                },
                "highlights": {
                    "$meta": "searchHighlights"
                }
            }
        }
    ]
    JSON;

    /**
     * Wildcard Example
     *
     * @see https://www.mongodb.com/docs/atlas/atlas-search/highlighting/#wildcard-example
     */
    case SearchWildcardExample = <<<'JSON'
    [
        {
            "$search": {
                "text": {
                    "path": {
                        "wildcard": "des*"
                    },
                    "query": [
                        "variety"
                    ]
                },
                "highlight": {
                    "path": {
                        "wildcard": "des*"
                    }
                }
            }
        },
        {
            "$project": {
                "description": {
                    "$numberInt": "1"
                },
                "_id": {
                    "$numberInt": "0"
                },
                "highlights": {
                    "$meta": "searchHighlights"
                }
            }
        }
    ]
    JSON;

    /**
     * Autocomplete Example
     *
     * @see https://www.mongodb.com/docs/atlas/atlas-search/highlighting/#autocomplete-example
     */
    case SearchAutocompleteExample = <<<'JSON'
    [
        {
            "$search": {
                "autocomplete": {
                    "path": "description",
                    "query": [
                        "var"
                    ]
                },
                "highlight": {
                    "path": "description"
                }
            }
        },
        {
            "$project": {
                "description": {
                    "$numberInt": "1"
                },
                "_id": {
                    "$numberInt": "0"
                },
                "highlights": {
                    "$meta": "searchHighlights"
                }
            }
        }
    ]
    JSON;

    /**
     * Compound Example
     *
     * @see https://www.mongodb.com/docs/atlas/atlas-search/highlighting/#compound-example
     */
    case SearchCompoundExample = <<<'JSON'
    [
        {
            "$search": {
                "compound": {
                    "should": [
                        {
                            "text": {
                                "path": "category",
                                "query": "organic"
                            }
                        },
                        {
                            "text": {
                                "path": "description",
                                "query": "variety"
                            }
                        }
                    ]
                },
                "highlight": {
                    "path": "description"
                }
            }
        },
        {
            "$project": {
                "description": {
                    "$numberInt": "1"
                },
                "category": {
                    "$numberInt": "1"
                },
                "_id": {
                    "$numberInt": "0"
                },
                "highlights": {
                    "$meta": "searchHighlights"
                }
            }
        }
    ]
    JSON;
}
