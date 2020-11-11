<?php

/**
 * @param array $data
 * @return bool
 */
function createCategory(array $data): bool
{
    $sql = 'INSERT INTO categories (title, parent_category_id) VALUES (?, ?)';
    $stmt = mysqli_prepare(getDb(), $sql);
    mysqli_stmt_bind_param($stmt, 'si', $data['title'], $data['parent_category_id']);
    return mysqli_stmt_execute($stmt);
}

/**
 * @return array
 */
function getCategories(): array
{
    $sql = 'SELECT * FROM categories';
    $stmt = mysqli_prepare(getDb(), $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
