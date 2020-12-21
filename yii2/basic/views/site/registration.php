<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;
use app\models\forms\RegistrationForm;

/**
 * @var View $this
 * @var RegistrationForm $model
 */

?>
<?php $form = ActiveForm::begin(['method' => 'post']) ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'login')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'repeatPassword')->passwordInput() ?>
    <?= Html::submitButton('Registration', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end();
