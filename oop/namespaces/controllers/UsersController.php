<?php

namespace controllers;

use models\Users;
use models\entities\User as UserEntity;
use models\auth\User as AuthUser;

/**
 * Class UsersController
 * @package controllers
 */
class UsersController
{
    /**
     * @return UserEntity[]
     */
    public function find(): array
    {
        return (new Users())->getAll();
    }

    public function auth()
    {
        $user = new UserEntity(2, 'Qwerty');

        $authUser = new AuthUser();
        $authUser->auth($user);

        return $authUser;
    }
}