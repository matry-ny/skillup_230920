<?php

error_reporting(E_ALL);

$int = 1;
$float = 1.93;
$string = ' 1231.2 test';
$bool = false;
$array = [1];
$null = null;
$object = new stdClass();
$resource = fopen(__DIR__ . '/basics.php', 'rb');
$callable = static function () {
  return 1;
};

//var_dump($object, $resource, $callable);
//var_dump($callable());
//var_dump(gettype($object));

//$result = 1 + 'test 1' + '%2' + ' 8';
//var_dump($result);

//var_dump((float)$string, (bool)'0');

fclose($resource);

//var_dump((float)str_replace(',', '.', '1,2'));

//var_dump(is_object($bool));

//var_dump(isset($null), empty($bool));

//var_dump(1 > 2, 1 < 2, 1 == 2, 1 >= 2, 1 <= 2);
//var_dump(null > 0, null == 0, null >= 0);
//var_dump(1 == '1', 1 === '1');
//var_dump(1 != 2, 1 != 1, 1 !== '1');
var_dump((bool)'test');
