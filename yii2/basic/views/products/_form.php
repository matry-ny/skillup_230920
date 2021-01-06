<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\entities\ProductCategoryEntity;

/**
 * @var yii\web\View $this
 * @var app\models\entities\ProductEntity $model
 */

?>

<div class="product-entity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ProductCategoryEntity::getDropdownElements()) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
