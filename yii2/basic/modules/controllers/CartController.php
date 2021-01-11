<?php

namespace app\modules\controllers;

use app\models\entities\CartEntity;
use app\modules\models\forms\AddProductToCardForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class CartController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'add' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $items = new ActiveDataProvider([
            'query' => CartEntity::find()->where(['user_id' => Yii::$app->user->id])
        ]);
        $total = CartEntity::find()->joinWith('product')->sum('products.price * cart.count');

        $this->view->title = Yii::t('app', 'Cart');
        return $this->render('index', ['items' => $items, 'total' => $total]);
    }

    public function actionAdd(): Response
    {
        $data = new AddProductToCardForm();
        if (!$data->load($this->request->post()) || !$data->validate()) {
            $errors = $data->getErrors();
            array_walk_recursive($errors, static function ($error) {
                Yii::$app->session->addFlash('error', $error);
            });

            return $this->redirect($this->request->getReferrer());
        }

        $userId = Yii::$app->user->getId();

        $model = CartEntity::findOne(['user_id' => $userId, 'product_id' => $data->productId]);
        if (!$model) {
            $model = new CartEntity();
            $model->user_id = $userId;
            $model->product_id = $data->productId;
        }

        $model->count += $data->count;

        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Product was added to card'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Product can not be added to card'));
        }
        return $this->redirect($this->request->getReferrer());
    }
}
