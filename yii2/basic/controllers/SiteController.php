<?php

namespace app\controllers;

use app\models\forms\ChangeLanguageForm;
use Yii;
use yii\captcha\CaptchaAction;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\forms\RegistrationForm;
use app\components\web\WebComponentsTrait;

class SiteController extends Controller
{
    use WebComponentsTrait;

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @return string|Response
     */
    public function actionRegistration()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'guest';
        $this->getView()->title = 'Registration';

        $model = new RegistrationForm();

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect('login');
        }

        return $this->render('registration', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'guest';
        $this->getView()->title = 'Login';

        $model = new LoginForm();
        if ($model->load($this->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->redirect('login');
    }

    public function actionSetLanguage(): Response
    {
        $model = new ChangeLanguageForm();
        if (!$model->load($this->request->post()) || !$model->validate()) {
            return $this->goBack();
        }

        $this->getLanguage()->set($model->language);
        return $this->goBack();
    }
}
