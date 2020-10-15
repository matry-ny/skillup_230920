<?php

$pow = 3 ** 3;
//var_dump($pow);

function power(int $number, int $power)
{
    if ($power === 0 || $number === 1) {
        return 1;
    }
    if ($power === 1 || $number === 0) {
        return $number;
    }

    return $number * power($number, $power - 1);
}

//$powRecursive = power(3, 3);
//var_dump($powRecursive);

$count = 0;

function fibonacci(int $n)
{
    static $lib = [];

    global $count;
    $count++;

    if ($n === 0) {
        return 0;
    }
    if ($n === 1) {
        return 1;
    }
    if (array_key_exists($n, $lib)) {
        return $lib[$n];
    }

    $index1 = $n - 2;
    $number1 = fibonacci($index1);

    $index2 = $n - 1;
    $number2 = fibonacci($index2);

    $lib[$index1] = $number1;
    $lib[$index2] = $number2;

    return $number1 + $number2;
}

$fibonacci = fibonacci(15);
var_dump($fibonacci, $count);


// Home work:
// modify power function
// create functions for printR and arrayCount
// - printR analog of print_r
// - arrayCount counts all array elements including nested