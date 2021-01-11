<?php

namespace app\modules\models\forms;

use yii\base\Model;

/**
 * Class AddProductToCardForm
 * @package app\modules\models\forms
 */
class AddProductToCardForm extends Model
{
    public ?int $productId = null;
    public ?int $count = null;

    public function rules(): array
    {
        return [
            [['productId', 'count'], 'required'],
            [['productId', 'count'], 'integer', 'min' => 1],
        ];
    }
}
