<?php

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
            [
                'name' => 'Med Max',
                'age' => 33,
            ],
            [
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
