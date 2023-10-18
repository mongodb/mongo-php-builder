/** @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/addFields/#using-two--addfields-stages */
module.exports.UsingTwoAaddFieldsStages = [
    {
        $addFields: {
            totalHomework: {$sum: "$homework"},
            totalQuiz: {$sum: "$quiz"}
        }
    },
    {
        $addFields: {
            totalScore: {
                $add: ["$totalHomework", "$totalQuiz", "$extraCredit"]
            }
        }
    }
]

/** @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/addFields/#adding-fields-to-an-embedded-document */
module.exports.AddingFieldsToAnEmbeddedDocument = [
    {
        $addFields: {
            "specs.fuel_type": "unleaded"
        }
    }
]
