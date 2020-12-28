<?php

namespace app\models\forms;

use Yii;
use app\models\entities\UserEntity;

class RegistrationForm extends UserEntity
{
    public string $repeatPassword = '';

    public function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                [['repeatPassword'], 'required'],
                [['repeatPassword'], 'compare', 'compareAttribute' => 'password'],
            ]
        );
    }

    public function beforeSave($insert): bool
    {
        $isOk = parent::beforeSave($insert);
        if ($isOk) {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        return $isOk;
    }
}
