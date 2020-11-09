<?php

session_start();

$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

if (!$login || !$password) {
    exit('Login and password are required');
}

$config = require __DIR__ . '/config.php';

$link = mysqli_connect(
    $config['db']['host'],
    $config['db']['user'],
    $config['db']['password'],
    $config['db']['db']
);

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$sql = "SELECT * FROM users WHERE login = ? LIMIT 1";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, 's', $login);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);
mysqli_free_result($result);

mysqli_close($link);


$passwordHash = $user['password'] ?? null;
if (!$passwordHash || !password_verify($password, $passwordHash)) {
    exit('Login or password is incorrect');
}

$_SESSION['user'] = $login;

header('Location: index.php');
