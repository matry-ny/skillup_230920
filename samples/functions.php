<?php

declare(strict_types=1);
error_reporting(E_ALL);

/**
 * @param string|null $name
 * @param string $result
 * @return string
 */
function getName(?string $name, string $result = 'PHP') : string
{
    $function = __FUNCTION__;
    return "{$name} + {$function} = {$result}" .  PHP_EOL;
}

$q = 'TEST';

/**
 * @param string|null $name
 * @param string $result
 * @param callable|null $callback
 */
function printName(?string $name, string $result = 'PHP', callable $callback = null) : void
{
    $q = 123;
    echo getName($name, $result);
    if ($callback) {
        $callback();
    }
}

$func1 = static function (int $a1 = 0) : void {
    echo mt_rand() . '_' . $a1 . PHP_EOL;
};

$printFunc = 'printName';
//$printFunc('Dmytro Kotenko');
//printName('Homer Simpson', 'Donut');
//printName(null, 'Shiny Ass', $func1);
//printName(123);

//var_dump($q);

//$func1(time());

$global1 = '123';

function globalFunction($global1) : void
{
    $functionVar = 3333;
    // CASE 1. Don't even mind
    /*
    var_dump('inside >>> ' . $GLOBALS['global1']);
    $GLOBALS['global1'] = mt_rand();
    unset($GLOBALS['global1']);
    */

    // CASE 2. Just mind. not realize
    /*
    global $global1;
    var_dump('inside >>> ' . $global1);
    $global1 = mt_rand();
    unset($global1);
    */

    // CASE 3. OK
    var_dump('inside >>> ' . $global1);
    $global1 = mt_rand();
    unset($global1);
}

//globalFunction($global1);
//var_dump('outside >>> ' . $global1);
//
//globalFunction($global1);
//var_dump('outside 2 >>> ' . $global1);

$globalFunction2 = static function () use ($global1) : int {
    var_dump('inside >>> ' . $global1);
    $global1 = mt_rand();
    unset($global1);

    return 1;
};

//$globalFunction2();
//var_dump('outside >>> ' . $global1);
//
//$globalFunction2();
//var_dump('outside 2 >>> ' . $global1);

function linkedFunc(&$link) : void
{
    var_dump('inside >>> ' . $link);
    $link = mt_rand();
    var_dump('inside 2 >>> ' . $link);
    unset($link);
    $link = mt_rand();
    var_dump('inside 3 >>> ' . $link);
}

//linkedFunc($global1);
//var_dump('outside >>> ' . $global1);

function returnFunction(string $arg) : string
{
    var_dump('inside >>> ' . $arg);
    $arg = (string)mt_rand();

    return $arg;
}

$global1 = returnFunction($global1);
var_dump('outside >>> ' . $global1);
