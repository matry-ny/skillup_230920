<?php

return [
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'db' => [
            'host' => 'db',
            'user' => 'skillup_user',
            'password' => 'skillup_pwd',
            'name' => 'skillup_db',
        ],
        'template' => [
            'viewsDir' => __DIR__ . '/../views',
            'layout' => 'layouts/main',
        ]
    ],
];
