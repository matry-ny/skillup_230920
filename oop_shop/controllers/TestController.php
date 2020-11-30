<?php


namespace app\controllers;

use app\components\AbstractController;

/**
 * Class TestController
 * @package app\controllers
 */
class TestController extends AbstractController
{
    public function actionQwerty(string $id, string $title, string $value = '')
    {
//        var_dump(__METHOD__, $id, $title, $value);exit;

        // $this->render('test/qwerty', ['p1' => 123])
    }
}
