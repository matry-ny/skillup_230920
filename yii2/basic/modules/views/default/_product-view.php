<?php

use app\modules\models\forms\AddProductToCardForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use app\models\entities\ProductEntity;

/**
 * @var ProductEntity $model
 */

$imageModel = $model->getMainImage();
$image = $imageModel ? Html::img(['/products/image', 'url' => $imageModel->url], ['width' => '100%']) : Yii::t('app', 'No image');

$addProductToCardModel = new AddProductToCardForm();
$addProductToCardModel->productId = $model->id;

?>
<div class="col-sm-4">
    <div class="product-image"><?= $image ?></div>
    <div class="product-title"><?= $model->title ?></div>
    <div class="product-price"><?= Yii::$app->formatter->asCurrency($model->price) ?></div>

    <?php $form = ActiveForm::begin(['action' => '/shop/cart/add', 'method' => 'post']) ?>
        <?= $form->field($addProductToCardModel, 'productId')->hiddenInput()->label(false) ?>
        <?= $form->field($addProductToCardModel, 'count')->textInput() ?>
        <?= Html::submitButton(Yii::t('app', 'Buy'), ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
</div>
