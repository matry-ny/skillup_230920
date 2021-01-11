<?php

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\search\ProductSearch;

/**
 * @var ProductSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

?>
<div class="shop-default-index">
    <h1><?= $this->title ?></h1>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_product-view'
    ]) ?>
</div>
