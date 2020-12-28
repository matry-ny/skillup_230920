<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class ChangeLanguageForm extends Model
{
    public string $language = '';

    public function rules(): array
    {
        return [
            ['language', 'required'],
            ['language', 'in', 'range' => array_keys(Yii::$app->params['languages'])]
        ];
    }
}
