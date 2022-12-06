const fs = require("fs")

const input = fs
    .readFileSync("input.txt")
    .toString()
    .split("\n")
    .filter((x) => Boolean(x))
    .map((x) => parseInt(x));

let count = 0;

for (let i = 0; i < input.length; i++) {
    let sumA = (input[i] + input[i + 1] + input[i + 2]) / 3;
    let sumB = (input[i + 1] + input[i + 2] + input[i + 3]) / 3;

    if (sumB > sumA) {
        count++;
    }
}
console.log(count);
