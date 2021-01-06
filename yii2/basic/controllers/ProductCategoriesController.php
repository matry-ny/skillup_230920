<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\entities\ProductCategoryEntity;
use app\models\search\ProductCategorySearch;
use app\components\web\SecuredController;

class ProductCategoriesController extends SecuredController
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new ProductCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $this->view->title = Yii::t('app', 'Product Categories');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id): string
    {
        $model = $this->findModel($id);

        $this->view->title = $model->title;
        return $this->render('view', ['model' => $model]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new ProductCategoryEntity();

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $this->view->title = Yii::t('app', 'Create Product Category');
        return $this->render('create', ['model' => $model]);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $this->view->title = Yii::t('app', 'Update Product Category: {name}', ['name' => $model->title]);
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel(int $id): ProductCategoryEntity
    {
        $model = ProductCategoryEntity::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $model;
    }
}
