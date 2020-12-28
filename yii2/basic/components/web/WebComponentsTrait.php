<?php

namespace app\components\web;

use Yii;

trait WebComponentsTrait
{
    public function getLanguage(): LanguageComponent
    {
        return Yii::$app->get('language');
    }
}
