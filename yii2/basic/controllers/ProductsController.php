<?php

namespace app\controllers;

use app\models\forms\AddProductImagesForm;
use Yii;
use app\models\entities\ProductEntity;
use app\models\search\ProductSearch;
use app\components\web\SecuredController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

class ProductsController extends SecuredController
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
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $this->view->title = Yii::t('app', 'Products');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id): string
    {
        $model = $this->findModel($id);
        
        $imageUploadModel = new AddProductImagesForm();
        $imageUploadModel->productId = $model->id;

        if ($this->request->isPost) {
            $imageUploadModel->imageFiles = UploadedFile::getInstances($imageUploadModel, 'imageFiles');
            $imageUploadModel->upload();
        }

        $this->view->title = $model->title;
        return $this->render('view', ['model' => $model, 'imageUploadModel' => $imageUploadModel]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new ProductEntity();

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $this->view->title = Yii::t('app', 'Create Product');
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $this->view->title = Yii::t('app', 'Update Product: {name}', ['name' => $model->title]);
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionImage(string $url): void
    {
        $file = Yii::getAlias('@storage') . "/{$url}";

        $this->response->format = Response::FORMAT_RAW;
        $this->response->stream = fopen($file, 'rb');
        if (!is_resource($this->response->stream)) {
            throw new NotFoundHttpException(Yii::t('app', 'File {url} access failed', ['url' => basename($file)]));
        }

        $this->response->send();
    }

    protected function findModel(int $id): ProductEntity
    {
        $model = ProductEntity::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $model;
    }
}
