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
        App::get()
            ->db()
            ->update('users')
            ->set(['name' => mt_rand()])
            ->where([
                ['id', '=', 4]
            ])
            ->execute();

        App::get()
            ->db()
            ->delete()
            ->from('users')
            ->where([
                ['id', '=', 3]
            ])
            ->execute();

        $query = App::get()
            ->db()
            ->select(['id', 'name', 'password'])
            ->from('users')
            ->where([
                ['id', '>', 4],
                ['id', '<', 10],
            ])
            ->andWhere([
                ['name', 'LIKE', '%2%'],
                ['id', 'IN', [5, 6, 7, 8]],
                ['name', 'IS NOT NULL']
            ])
            ->orWhere([
                ['created_at', 'BETWEEN', '2020-12-09 17:00:00', '2020-12-09 20:59:59'],
            ]);

        var_dump($query->buildSQL(), $query->all(), $query->one());exit();

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
