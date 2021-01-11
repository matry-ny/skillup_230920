<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveDataProvider $items
 */

?>
<?= GridView::widget([
    'dataProvider' => $items,
    'columns' => [
        [
            'attribute' => 'product_id',
            'value' => 'product.title'
        ],
        'count',
        'created_at:datetime',
    ],
]);
