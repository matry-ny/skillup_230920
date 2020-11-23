<?php

error_reporting(E_ALL);

require_once __DIR__ . '/autoload.php';

$controller = new controllers\UsersController();
var_dump($controller->find(), $controller->auth());

