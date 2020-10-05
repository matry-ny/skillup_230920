<?php

error_reporting(E_ALL);

//var_dump((2 + 2) * 2 / 5 - 0.6);
//var_dump(('2' + '2') * '2' / '5' - 's0.6');
//var_dump(2/3);
//var_dump(pow(3, 3), 3 ** 3);
//var_dump(6 % 2);

$count = 0;
$count = $count + 1;
$count += 1;
$count++;
++$count;
//var_dump($count);

$count2 = 0;
$count2 = $count2 - 1;
$count2 -= 1;
$count2--;
--$count2;
//var_dump($count2);

$int1 = 1;
$int2 = 2;
$int3 = 3;
$result = $int1++ + $int1 + $int2++ + ++$int3;
$result2 = $int1 + $int2 + $int3;
var_dump($result, $result2);
