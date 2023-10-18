module.exports.UseInGroupStage = [
    {
        $group: {
            _id: {day: {$dayOfYear: {date: "$date"}}, year: {$year: {date: "$date"}}},
            itemsSold: {$addToSet: "$item"}
        }
    }
]

module.exports.UseInSetWindowFieldsStage = [
    {
        $setWindowFields: {
            partitionBy: "$state",
            sortBy: {orderDate: 1},
            output: {
                cakeTypesForState: {
                    $addToSet: "$type",
                    window: {
                        documents: ["unbounded", "current"]
                    }
                }
            }
        }
    }
]
