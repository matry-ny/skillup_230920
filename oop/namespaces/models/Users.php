<?php

namespace models;

use models\entities\User;

/**
 * Class Users
 */
class Users
{
    /**
     * @return User[]
     */
    public function getAll(): array
    {
        return [
            new User(1, 'Test'),
            new User(2, 'Qwerty'),
            new User(3, 'Vasya'),
            new User(4, 'Mark'),
        ];
    }
}