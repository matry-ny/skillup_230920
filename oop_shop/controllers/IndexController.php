<?php


namespace app\controllers;

use app\components\AbstractController;

/**
 * Class IndexController
 * @package app\controllers
 */
class IndexController extends AbstractController
{
    public function actionIndex(): string
    {
        return $this->render('index/index', ['test' => 123]);
    }
}
