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
        var_dump($validator->getValidData(), $validator->getErrors());
    }
}
