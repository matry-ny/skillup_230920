<?php

namespace app\controllers;

use app\components\AbstractController;
use app\models\UserEntity;

/**
 * Class GuestController
 * @package app\controllers
 */
class GuestController extends AbstractController
{
    public function actionRegistration(): string
    {
        $model = new UserEntity();
        if ($model->load($this->request()->post()) && $model->save()) {
            $this->redirect('/guest/login');
        }

        return $this->render('guest/registration', ['model' => $model], 'layouts/guest');
    }

    public function actionLogin(): string
    {
        return $this->render('guest/login', [], 'layouts/guest');
    }
}
