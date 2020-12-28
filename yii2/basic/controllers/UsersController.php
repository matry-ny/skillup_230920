<?php

namespace app\controllers;

use app\models\forms\RegistrationForm;
use Yii;
use app\models\entities\UserEntity;
use app\models\search\UserSearch;
use app\components\web\SecuredController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends SecuredController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
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
        $this->view->title = Yii::t('app', 'Users');

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id): string
    {
        $model = $this->findModel($id);
        $this->view->title = Yii::t('app', "User: {$model->name}");

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $this->view->title = Yii::t('app', 'Create User');

        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $this->view->title = Yii::t('app', "Update User: {$model->name}");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel(int $id): UserEntity
    {
        $model = UserEntity::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $model;
    }
}
