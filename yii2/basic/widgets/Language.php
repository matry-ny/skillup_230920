<?php
namespace app\widgets;

use Yii;
use yii\bootstrap\Widget;
use yii\bootstrap\ActiveForm;
use app\models\forms\ChangeLanguageForm;

class Language extends Widget
{
    public function run(): void
    {
        $model = new ChangeLanguageForm();
        $model->language = Yii::$app->language;

        $form = ActiveForm::begin(['method' => 'post', 'action' => ['/site/set-language']]);
        echo $form
            ->field($model, 'language')
            ->dropDownList(Yii::$app->params['languages'], ['onchange' => 'this.form.submit();'])
            ->label(false);
        ActiveForm::end();
    }
}
