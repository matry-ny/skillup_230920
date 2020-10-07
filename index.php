<?php

echo 'Hello world', PHP_EOL;

$menu = [
    [
        'title' => 'Samples',
        'children' => [
            [
                'url' => '/',
                'title' => 'Home',
            ],
            [
                'url' => '/samples/arrays.php',
                'title' => 'Arrays',
            ],
            [
                'url' => '/samples/basics.php',
                'title' => 'Basics',
            ],
            [
                'url' => '/samples/branching.php',
                'title' => 'Branching',
            ],
            [
                'url' => '/samples/html.php',
                'title' => 'HTML',
            ],
            [
                'url' => '/samples/math.php',
                'title' => 'Math',
            ],
            [
                'url' => '/samples/types.php',
                'title' => 'Types',
            ],
        ],
    ]
];

var_dump($menu);
