<?php
namespace app\widgets;

use Yii;
use yii\helpers\Html;
use yii\bootstrap\Widget;
use app\models\entities\CartEntity;

class Cart extends Widget
{
    public function run(): void
    {
        $count = CartEntity::find()->where(['user_id' => Yii::$app->user->getId()])->count();
        echo Html::a(Yii::t('app', 'Cart: {0} items', [$count]), ['/shop/cart']);
    }
}
