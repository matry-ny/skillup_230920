<?php

use kartik\date\DatePicker;
use yii\grid\ActionColumn;
use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\search\UserEntitySearch;

/**
 * @var View $this
 * @var UserSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('create')): ?>
        <p><?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?></p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            'login',
            'is_active:boolean',

            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                ])
            ],

            [
                'class' => ActionColumn::class,
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('view'),
                    'update' => Yii::$app->user->can('update'),
                    'delete' => Yii::$app->user->can('delete')
                ]
            ],
        ],
    ]) ?>

</div>
