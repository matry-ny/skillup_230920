<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\models\entities\ProductCategoryEntity;

/**
 * @var yii\web\View $this
 * @var app\models\search\ProductCategorySearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-entity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            [
                'attribute' => 'parent_id',
                'value' => 'parent.title',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'parent_id',
                    ProductCategoryEntity::getDropdownElements(),
                    ['class' => 'form-control', 'prompt' => '--']
                ),
            ],
            'created_at:datetime',

            ['class' => ActionColumn::class],
        ],
    ]) ?>

</div>
