<?php

return [
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'db' => [
            'host' => '',
            'user' => '',
            'password' => '',
            'name' => '',
        ],
        'template' => [
            'viewsDir' => __DIR__ . '/../views',
            'layout' => 'layouts/main',
        ]
    ],
];
