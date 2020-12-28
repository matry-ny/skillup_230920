<?php

use app\components\Template;
use app\helpers\ArraysHelper;
use app\models\UserEntity;


/**
 * @var Template $this
 * @var UserEntity $model
 */

$model = $this->variables['model'];

$nameErrors = ArraysHelper::find('name', $model->getErrors(), []);
$loginErrors = ArraysHelper::find('login', $model->getErrors(), []);
$passwordErrors = ArraysHelper::find('password', $model->getErrors(), []);

?>
<form class="form-signin" method="post">
    <img class="mb-4" src="/public/img/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please enter your information</h1>

    <label for="user-name" class="sr-only">Name</label>
    <input type="text"
           name="name"
           value="<?= $model->name ?>"
           class="form-control"
           id="user-name"
           placeholder="Enter your name"
           required
           autofocus>
    <?php foreach ($nameErrors as $error): ?>
        <div class="invalid-feedback d-block text-left"><?= $error ?></div>
    <?php endforeach; ?>

    <label for="user-login" class="sr-only">Login</label>
    <input type="text"
           name="login"
           value="<?= $model->login ?>"
           class="form-control"
           placeholder="Enter your login"
           id="user-login"
           required>
    <?php foreach ($loginErrors as $error): ?>
        <div class="invalid-feedback d-block text-left"><?= $error ?></div>
    <?php endforeach; ?>

    <label for="user-password" class="sr-only">Password</label>
    <input type="password"
           name="password"
           value=""
           class="form-control"
           placeholder="Enter your password"
           id="user-password"
           required>
    <?php foreach ($passwordErrors as $error): ?>
        <div class="invalid-feedback d-block text-left"><?= $error ?></div>
    <?php endforeach; ?>

    <label for="user-repeat-password" class="sr-only">Repeat password</label>
    <input type="password"
           name="repeatPassword"
           value=""
           class="form-control"
           placeholder="Repeat your password"
           id="user-repeat-password"
           required>

    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Registration</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-<?= date('Y') ?></p>
</form>