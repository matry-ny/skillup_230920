<?php

$attachment = $_FILES['attachment'] ?? null;
$baseInsideDir = $_POST['baseDir'] ?? '';

if (!$attachment) {
    exit('Uploading can not be completed');
}

$config = require __DIR__ . '/config.php';

$rout = sprintf(
    '%s/%s/%s',
    rtrim($config['baseDir'], '/'),
    rtrim($baseInsideDir, '/'),
    trim($attachment['name'])
);

move_uploaded_file($attachment['tmp_name'], $rout);

header("Location: index.php?rout={$baseInsideDir}");
exit;
