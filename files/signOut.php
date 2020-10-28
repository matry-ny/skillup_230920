<?php

error_reporting(E_ALL);

require_once __DIR__ . '/security.php';

session_unset();
session_destroy();

header('Location: index.php');
exit;
