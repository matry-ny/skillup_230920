<?php

error_reporting(E_ALL);

$config = require __DIR__ . '/config.php';

require_once __DIR__ . '/lib/dispatcher.php';
require_once __DIR__ . '/lib/db.php';

setDb($config);
dispatch($_SERVER['REQUEST_URI'], $config);

// Home work
// 1. Authentication
// 2. CRUD categories (Create Read Update Delete)
