<?php

//ob_start();
//echo 'Some output text';
//echo 123123213;
//$data = ob_get_clean();
//
//$data .= ' UPDATED';
//
//var_dump($data);

$data = ['Test 1', 'Test 2', 'Test 3', 'Test 4'];

ob_start();
require_once __DIR__ . '/templates/inner.php';
$content = ob_get_clean();

require_once __DIR__ . '/templates/global.php';
