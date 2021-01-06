<?php

namespace app\models;

use yii\helpers\ArrayHelper;

trait DropdownListTrait
{
    public static function getDropdownElements(string $key = 'id', string $value = 'title'): array
    {
        return ArrayHelper::map(self::find()->all(), $key, $value);
    }
}
