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
<h1 class="text-center"><?= $this->title ?></h1>
<?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['class' => 'form-signin']]) ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'login')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'repeatPassword')->passwordInput() ?>
    <?= Html::submitButton('Registration', ['class' => 'btn btn-success']) ?>
    <span> or </span>
    <?= Html::a('Login', ['site/login']) ?>
<?php ActiveForm::end(); ?>
