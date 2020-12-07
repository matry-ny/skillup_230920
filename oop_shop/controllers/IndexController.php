<?php


namespace app\controllers;

use app\components\AbstractSecuredController;

/**
 * Class IndexController
 * @package app\controllers
 */
class IndexController extends AbstractSecuredController
{
    public function actionIndex(): string
    {
        return $this->render('index/index', ['test' => 123]);
    }
}
