<?php

namespace models\auth;

use models\entities\User as UserEntity;

/**
 * Class User
 * @package models\auth
 */
class User
{
    private ?UserEntity $user;

    public function auth(UserEntity $user)
    {
        $this->user = $user;
    }
}
