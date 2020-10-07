<?php

error_reporting(E_ALL);

$a1 = array('test', 'qwerty', 123);
$a2 = [4 => 'test', 2 => 'qwerty', 123];
$a3 = [
    'key1' => 'Test',
    'color' => 'Red',
    'car' => 'Subaru',
    'Dmytro'
];
$groups = [
    [
        'id' => 1,
        'name' => 'PHP Basics',
        'students' => [
            's1' => [
                'name' => 'Med Max',
                'age' => 33,
            ],
            's2' => [
                'name' => 'Ned Flanders',
                'age' => 52,
            ],
        ],
    ],
    [
        'id' => 2,
        'name' => 'JS Basics',
        'students' => [
            [
                'name' => 'Bart Simpson',
                'age' => 11,
            ],
            [
                'name' => 'Bender Rodriges',
                'age' => 90,
            ],
        ],
    ],
];

//var_dump(
//    $groups[1]['name'],
//    $groups[1]['students'][0]['name']
//);

$groups[0]['students'][] = [
    'name' => 'Homer Simpson',
    'age' => 45,
];

//$groups[0] = 1;

array_push($groups[0]['students'], [
    'name' => 'Marge Simpson',
    'age' => 35,
]);

//var_dump($groups);

$string = 'Hello World';
//var_dump($string[0], $string[-1]);

$a4 = [
    'qwerty',
    10,
    4,
    1,
    6,
    10 => 'test',
    15 => 'test',
];

rsort($a4);

//var_dump($a4);

$students = $groups[0]['students'];

usort($students, static function (array $a, array $b) : int {
    return $b['age'] <=> $a['age'];
});

//var_dump(count($groups));

$a4Start = array_shift($a4);
$a4_2 = $a4[2];
unset($a4[2]);
//var_dump(
//    $a4Start,
//    $a4_2,
//    $a4,
//    array_key_exists(2, $a4),
//    in_array('qwerty', $a4),
////    array_unique($a4)
//    array_flip(array_flip($a4)),
//    compact('a4Start', 'a4_2', 'students')
//);

$GLOBALS['a4_2'] = 123123123132;

//session_start();
//var_dump($_SESSION['test']);

///////// Home Work
/// Task manager
/// - task ID
/// - task title
/// - task description
/// - task owner
/// - task deadline
/// - task status
/// - subtasks
/// --
