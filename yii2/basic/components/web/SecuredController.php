<?php

namespace app\components\web;

use Yii;
use yii\base\Action;
use yii\web\Controller;
use yii\web\BadRequestHttpException;

class SecuredController extends Controller
{
    /**
     * @param Action $action
     * @return bool|void
     * @throws BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action) && Yii::$app->user->isGuest) {
            $this->redirect(['site/login'])->send();
        }
    }
}
