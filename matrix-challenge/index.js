const data = [
    [1, 2, 3],
    [4, 5, 6],
    [9, 8, 9],
];

const getDiagonalsDifference = (matrix = [[]]) => {
    let d1 = 0;
    let d2 = 0;
    for (let i in matrix) {
        if (matrix[i].length !== matrix.length)
            throw new Error("This matrix is not square");

        d1 += matrix[i][i];
        const reverseIndex = matrix.length - 1 - i;
        d2 += matrix[i][reverseIndex];
    }
    return d1 - d2;
};

console.log(getDiagonalsDifference(data));
