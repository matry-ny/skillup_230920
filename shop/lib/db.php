<?php

$dbConnection = null;

/**
 * @param array $config
 */
function setDb(array $config): void
{
    global $dbConnection;

    $dbConnection = mysqli_connect(
        $config['db']['host'],
        $config['db']['user'],
        $config['db']['password'],
        $config['db']['db']
    );

    if (!$dbConnection) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
}

/**
 * @return mysqli
 */
function getDb(): mysqli
{
    global $dbConnection;

    if ($dbConnection === null) {
        exit('DB connection is lost');
    }

    return $dbConnection;
}
