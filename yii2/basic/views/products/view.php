<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\entities\ProductEntity $model
 * @var app\models\forms\AddProductImagesForm $imageUploadModel
 */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-entity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php foreach ($model->images as $image): ?>
        <?= Html::img(['image', 'url' => $image->url], ['class' => 'col-sm-3']) ?>
    <?php endforeach ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => $model->category->title
            ],
            'title',
            'slug',
            'price',
            'created_at:datetime',
        ],
    ]) ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form
            ->field($imageUploadModel, 'imageFiles[]')
            ->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

        <?= Html::submitButton(Yii::t('app', 'Add images')) ?>

    <?php ActiveForm::end() ?>

</div>
