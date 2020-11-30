<?php


namespace app\controllers;

use app\components\AbstractController;

/**
 * Class IndexController
 * @package app\controllers
 */
class IndexController extends AbstractController
{
    public function actionIndex()
    {
        var_dump(__METHOD__);
    }
}
