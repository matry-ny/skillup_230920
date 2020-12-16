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
//        $al = new AccessLog();
//        var_dump($al);
//
//        $roles = ['admin', 'publisher', 'user'];
//        $suffix = date('Y-m-d H:i:s');
//        $user2 = new User();
//        $user2->name = "Created AR {$suffix}";
//        $user2->login = "created_ar_{$suffix}";
//        $user2->password = mt_rand() . time();
//        $user2->role = $roles[random_int(0, 2)];
//
//        $user2->save();

//        var_dump($user2, $user2->id, $user2->role);exit;


//        var_dump($user2);
        $user = User::findOne([['id', '=', 11]]);
//        $user->name = 'Name ' . date('Y-m-d H:i:s');
//        $user->save();
        $user->delete();

        $user->name = 'New 12';
        $user->login = 'new_12';
        $user->password = 'fasdfnasiu';
        $user->save();

        var_dump($user);exit;


//        $users = User::findAll([['id', '>', 4]]);
//        var_dump($user->id, $user->name, $user->password);exit;
//        $user->name = 'New Name';
//        $user->save();
//
//        $user->delete();
//
//        $user2 = new User();
//        $user2->name = 'TEST User 2';
//        $user2->login = '1111';
//        $user2->password = 'p1111p';
//        $user2->save();
//
//        $user2->name = 'Updated';
//        $user2->save();
//
//        $user->delete();

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
