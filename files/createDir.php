<?php

$baseDir = $_POST['baseDir'] ?? null;
$name = $_POST['name'] ?? null;

if (!$baseDir || !$name) {
    exit('Dir and name are required');
}

$rout = rtrim($baseDir, '/') . '/' . ltrim($name);

if (!mkdir($rout) && !is_dir($rout)) {
    exit(sprintf('Directory "%s" was not created', $rout));
}

header("Location: index.php?rout={$baseDir}");
exit;
