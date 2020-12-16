<?php

namespace app\models;

use app\components\App;
use app\components\db\ActiveRecord;
use app\components\validators\CompareValidator;
use app\components\validators\RegExpValidator;
use app\components\validators\StringValidator;

/**
 * Class User
 * @package app\models
 *
 * @property int id
 * @property string name
 * @property string login
 * @property string password
 * @property string role
 * @property string created_at
 * @property string updated_at
 * @property bool is_active
 */
class User extends ActiveRecord
{
    /**
     * @return string
     */
    protected function tableName(): string
    {
        return 'users';
    }

    public string $repeatPassword = '';

    protected array $extendedFields = [
        'repeatPassword'
    ];

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name' => [new StringValidator(3, 50)],
            'login' => [new StringValidator(8, 50)],
            'password' => [
                new StringValidator(8, 20),
                new RegExpValidator("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/"),
                new CompareValidator('repeatPassword')
            ],
        ];
    }
}
