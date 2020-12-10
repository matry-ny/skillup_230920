<?php

namespace app\controllers;

use app\components\AbstractController;
use app\components\App;
use app\models\User;

/**
 * Class GuestController
 * @package app\controllers
 */
class GuestController extends AbstractController
{
    public function actionRegistration(): string
    {
        $query = App::get()
            ->db()
            ->select(['id', 'name', 'password'])
            ->from('users')
            ->where([
                ['id', '>', 4],
                ['id', '<', 10],
                ['name', 'like', '%2%'],
                ['created_at', 'between', '2020-12-09 17:00:00', '2020-12-09 20:59:59'],
            ]);

        var_dump($query->all(), $query->one());exit();

        if ($this->request()->isPost()) {
            $model = new User();
            $model->load($this->request()->post());
            $model->createUser();
            exit;
        }
        return $this->render('guest/registration', [], 'layouts/guest');
    }

    public function actionLogin(): string
    {
        return $this->render('guest/login', [], 'layouts/guest');
    }
}
