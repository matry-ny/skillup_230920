<?php

declare(strict_types=1);

error_reporting(E_ALL);

use app\components\App;

require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/configs/web.php';
App::init($config);


// URL: local-shop.com:8011/product-category/edit?p1=2&p2=3
// Generate controller class: \app\controllers\ProductCategoryController
// Generate action method: actionEdit
// (new \app\controllers\ProductCategoryController())->actionEdit($p1, $p2);


// регистронезависимые параметры
// 'components.db.host' должен вернуть значение из $this->config['components']['db']['host']
// реализовать проброс класса App в контроллеры и реализовать шаблонизатор через буфферизацию вывода
