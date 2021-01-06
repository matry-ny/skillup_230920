<?php

use app\models\entities\ProductCategoryEntity;
use yii\bootstrap\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var app\models\search\ProductSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-entity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product Entity'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => 'category.title',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    ProductCategoryEntity::getDropdownElements(),
                    ['class' => 'form-control', 'prompt' => '--']
                ),
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => static function (\app\models\entities\ProductEntity $product) {
                    $image = $product->images[0] ?? null;
                    if (!$image) {
                        return Yii::t('app', 'No image');
                    }
                    return Html::img(['image', 'url' => $image->url], ['width' => '100%']);
                }
            ],
            'title',
            'slug',
            'price',
            'created_at:datetime',

            ['class' => ActionColumn::class],
        ],
    ]); ?>


</div>
