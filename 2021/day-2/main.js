const fs = require("fs")

const lines = fs
    .readFileSync("input.txt", { encoding: "utf8" })
    .split("\n")
    .filter((x) => Boolean(x))
    .map((x) => {
        const [direction, amount] = x.split(" ");
        return {
            direction,
            amount: parseInt(amount)
        };
    });

const submarine = {
    hPos: 0,
    depth: 0,
    aim: 0
};

lines.forEach((line) => {
    switch (line.direction) {
        case "up":
            submarine.aim -= parseInt(line.amount);
            break;
        case "down":
            submarine.aim += parseInt(line.amount);
            break;
        case "forward":
            submarine.hPos += parseInt(line.amount);
            submarine.depth += (submarine.aim * parseInt(line.amount));
            break;
        default:
            console.log("Unknown direction");
    }

});

const distance = submarine.hPos * submarine.depth;
console.log(distance);