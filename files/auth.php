<?php

session_start();

$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

if (!$login || !$password) {
    exit('Login and password are required');
}

$config = require __DIR__ . '/config.php';

$users = $config['users'];

$passwordHash = $users[$login] ?? null;
if (!$passwordHash || !password_verify($password, $passwordHash)) {
    exit('Login or password is incorrect');
}

$_SESSION['user'] = $login;

header('Location: index.php');
