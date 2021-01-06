<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\entities\ProductCategoryEntity;

/**
 * @var yii\web\View $this
 * @var ProductCategoryEntity $model
 */

?>

<div class="product-category-entity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form
        ->field($model, 'parent_id')
        ->dropDownList(ProductCategoryEntity::getDropdownElements()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
