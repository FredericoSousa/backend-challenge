<?php
$data = [
    [1, 2, 3],
    [4, 5, 6],
    [9, 8, 9],
];

function getDiagonalsDifference(array $matrix): int
{
    $d1 = 0;
    $d2 = 0;
    foreach ($matrix as $i => $v) {
        if (count($matrix[$i]) !== count($matrix))
            throw new Error('This matrix is not square');

        $d1 += $matrix[$i][$i];
        $reverseIndex = count($matrix) - 1 - $i;
        $d2 += $matrix[$i][$reverseIndex];
    }
    return $d1 - $d2;
}

var_dump(getDiagonalsDifference($data));
