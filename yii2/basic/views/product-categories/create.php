<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\entities\ProductCategoryEntity $model
 */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-entity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
