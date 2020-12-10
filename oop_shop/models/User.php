<?php

namespace app\models;

use app\components\App;
use app\components\validators\CompareValidator;
use app\components\validators\RegExpValidator;
use app\components\validators\StringValidator;

/**
 * Class User
 * @package app\models
 */
class User
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $login = null;
    private ?string $password = null;
    private ?string $role = null;
    private bool $is_active = false;

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'name' => [new StringValidator(3, 50)],
            'login' => [new StringValidator(8, 50)],
            'password' => [
                new StringValidator(8, 20),
                new RegExpValidator("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/"),
                new CompareValidator('repeat-password')
            ],
        ];
    }

    public function load(array $data)
    {
        $validator = App::get()->validator($data, $this->rules())->run();
        foreach ($validator->getValidData() as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function createUser()
    {
        $query = App::get()
            ->db()
            ->insert([
                'name' => $this->name,
                'login' => $this->login,
                'password' => $this->password,
            ])
            ->into('users')
            ->execute();

        var_dump($query);

//        $sql = <<<SQL
//            INSERT INTO `users`
//                (`name`, `login`, `password`, `role`, `is_active`)
//            VALUES
//                ('{$this->name}', '{$this->login}', '{$this->password}', '{$this->role}', '{$this->is_active}')
//        SQL;
//
//        $this
//            ->insert([
//                'name' => $this->name,
//                'login' => $this->login,
//                'password' => $this->password,
//                'role' => $this->role,
//                'is_active' => $this->is_active,
//            ])
//            ->into('users')
//            ->save();
    }
}
