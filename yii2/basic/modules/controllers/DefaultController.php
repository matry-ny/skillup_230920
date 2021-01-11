<?php

namespace app\modules\controllers;

use app\models\search\ProductSearch;
use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex(): string
    {
        $this->view->title = Yii::t('app', 'Products');

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
