<?php

use yii\grid\ActionColumn;
use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\search\UserSearch;

/**
 * @var View $this
 * @var UserSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'login',
            'is_active:boolean',
            'created_at:datetime',

            ['class' => ActionColumn::class],
        ],
    ]); ?>


</div>
