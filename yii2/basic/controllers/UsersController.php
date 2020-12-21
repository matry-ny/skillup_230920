<?php

namespace app\controllers;

use app\components\web\SecuredController;

class UsersController extends SecuredController
{
    public function actionIndex()
    {
        var_dump(__METHOD__);exit;
    }
}
