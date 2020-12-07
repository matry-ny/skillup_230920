<?php


namespace app\controllers;

use app\components\AbstractSecuredController;

/**
 * Class TestController
 * @package app\controllers
 */
class TestController extends AbstractSecuredController
{
    public function actionQwerty(): string
    {
        return $this->render('test/qwerty', ['p1' => 123]);
    }
}
