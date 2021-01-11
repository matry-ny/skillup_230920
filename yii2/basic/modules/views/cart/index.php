<?php

use app\models\entities\CartEntity;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveDataProvider $items
 * @var float $total
 */

?>
<h1><?= $this->title ?></h1>
<?= GridView::widget([
    'dataProvider' => $items,
    'showFooter' => true,
    'columns' => [
        [
            'attribute' => 'product_id',
            'value' => 'product.title'
        ],
        'count',
        [
            'label' => Yii::t('app', 'Total'),
            'value' => static function (CartEntity $model) {
                return $model->product->price * $model->count;
            },
            'format' => 'currency',
            'footer' => Yii::$app->formatter->asCurrency($total),
        ],
        'created_at:datetime',
    ],
]);
