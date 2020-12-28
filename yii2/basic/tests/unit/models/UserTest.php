<?php

namespace tests\unit\models;

use app\models\UserEntity;
use Codeception\Test\Unit;

class UserTest extends Unit
{
    public function testFindUserById()
    {
        expect_that($user = UserEntity::findIdentity(100));
        expect($user->username)->equals('admin');

        expect_not(UserEntity::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        expect_that($user = UserEntity::findIdentityByAccessToken('100-token'));
        expect($user->username)->equals('admin');

        expect_not(UserEntity::findIdentityByAccessToken('non-existing'));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = UserEntity::findByUsername('admin'));
        expect_not(UserEntity::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = UserEntity::findByUsername('admin');
        expect_that($user->validateAuthKey('test100key'));
        expect_not($user->validateAuthKey('test102key'));

        expect_that($user->validatePassword('admin'));
        expect_not($user->validatePassword('123456'));        
    }

}
