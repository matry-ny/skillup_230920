<?php

namespace app\models;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\IdentityInterface;
use app\exceptions\DBException;
use app\exceptions\InvalidConfigException;

class User extends entities\UserEntity implements IdentityInterface
{
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int|string $id
     * @return static|null
     * @throws DBException
     * @throws InvalidConfigException
     */
    public static function findIdentity($id): ?self
    {
        return self::findOne($id);
    }

    public static function findByUsername(string $username): ?self
    {
        return self::findOne(['login' => $username]);
    }

    public function validatePassword(string $password): bool
    {
        try {
            return Yii::$app->security->validatePassword($password, $this->password);
        } catch (InvalidArgumentException $extends) {
            return false;
        }
    }

    /**
     * @param mixed $token
     * @param null $type
     */
    public static function findIdentityByAccessToken($token, $type = null): void
    {
    }

    public function getAuthKey(): void
    {
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return false;
    }
}
