<?php

namespace app\models\forms;

class RegistrationForm extends \yii\base\Model
{
    public string $name = '';
    public string $login = '';
    public string $password = '';
    public string $repeatPassword = '';

    public function rules(): array
    {
        return [
            [['name', 'login', 'password', 'repeatPassword'], 'required'],
            [['name'], 'string', 'min' => 3, 'max' => 100],
            [['login'], 'string', 'min' => 5, 'max' => 100],
//            [['login', 'unique', ]],
            [['password'], 'compare', 'compareAttribute' => 'repeatPassword'],
        ];
    }
}
