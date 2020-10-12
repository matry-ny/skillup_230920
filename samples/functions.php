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
$printFunc('Dmytro Kotenko');
printName('Homer Simpson', 'Donut');
printName(null, 'Shiny Ass', $func1);
//printName(123);

var_dump($q);

$func1(time());
