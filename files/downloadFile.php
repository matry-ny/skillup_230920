<?php

error_reporting(E_ALL);

require_once __DIR__ . '/security.php';

$rout = trim($_GET['rout'] ?? null, " \t\n\r\0\x0B/");
if (!$rout) {
    exit('Rout is required');
}

$config = require __DIR__ . '/config.php';

$baseDir = rtrim($config['baseDir'], '/');
$file = "{$baseDir}/{$rout}";

if (!file_exists($file)) {
    exit('File not exists');
}


$mimeType = mime_content_type($file);
$fileName = basename($file);
$fileSize = filesize($file);

header("Content-Type: {$mimeType}");
header("Content-Disposition: attachment; filename={$fileName}");
header("Content-Length: {$fileSize}");
header('Pragma: no-cache');
readfile($file);
exit;
