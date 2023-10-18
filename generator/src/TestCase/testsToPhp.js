/**
 * Node script to convert test pipelines from JS into PHP code.
 */
const fs = require('fs');

function toPhp(object, indent = 0) {
    const newline = '\n' + ('    '.repeat(indent));
    const newlineplus1 = '\n' + ('    '.repeat(indent + 1));
    if (object === null) {
        return 'null';
    }

    if (Array.isArray(object)) {
        if (object.length <= 1) {
            return '[' + object.map((item) => toPhp(item, indent)) + ']';
        }

        return '[' + newlineplus1 + object.map((item) => toPhp(item, indent + 1)).join(',' + newlineplus1) + ',' + newline + ']';
    }

    switch (typeof object) {
        case 'boolean':
            return object ? 'true' : 'false';
        case 'string':
            return "'" + object.replace(/'/g, "\\'") + "'";
        case 'number':
            return object.toString();
        case 'object':
            var dump = [];
            for (var key in object) {
                dump.push("'" + key.replace(/'/g, "\\'") + "' => " + toPhp(object[key], indent + 1));
            }

            return '(object) [' + newlineplus1 + dump.join(',' + newlineplus1) + ',' + newline + ']';
        case 'function':
            return 'new \\MongoDB\\BSON\\Javascript(\''
                + object.toString()
                    .replace(/\/\*[\s\S]*?\*\/|\/\/.*/g, '')
                    .replace(/\s+/g, ' ')
                + '\')';
        default:
            return '"Unsupported type: ' + typeof object + '"';
    }
}

// Get the file path from the command-line arguments
const args = process.argv.slice(2);

if (args.length !== 1) {
    console.error('Usage: node ${path.basename(__filename)} <tests_file_path>');
    process.exit(1);
}

const constantsFilePath = args[0];

try {
    const tests = require(constantsFilePath);

    for (const name in tests) {
        if (Object.prototype.hasOwnProperty.call(tests, name)) {
            tests[name] = toPhp(tests[name], 0);
        }
    }

    // Print the transformed constants to the standard output
    console.log(JSON.stringify(tests));
} catch (err) {
    console.error('Error reading the constants file:', err.message);
}
