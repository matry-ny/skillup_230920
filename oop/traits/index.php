<?php

error_reporting(E_ALL);

require_once __DIR__ . '/GoogleApi.php';
require_once __DIR__ . '/YandexTrait.php';
require_once __DIR__ . '/Product.php';

$product = new Product();
$product->sale();
