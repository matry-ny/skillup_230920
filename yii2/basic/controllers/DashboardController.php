<?php

namespace app\controllers;

use Yii;
use app\components\web\SecuredController;

class DashboardController extends SecuredController
{
    public function actionIndex(): string
    {
        $this->view->title = Yii::t('app', 'Dashboard');
        return $this->render('index');
    }
}
