<?php


namespace app\controllers;

use app\components\AbstractController;

/**
 * Class TestController
 * @package app\controllers
 */
class TestController extends AbstractController
{
    public function actionQwerty(): string
    {
        return $this->render('test/qwerty', ['p1' => 123]);
    }
}
