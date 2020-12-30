<?php

use yii\web\View;

/**
 * @var View $this
 */

?>
<h1><?= $this->title ?></h1>

<?php if (Yii::$app->user->can('view')): ?>
<h3>Can View</h3>
<?php endif; ?>

<?php if (Yii::$app->user->can('update')): ?>
<h3>Can Edit</h3>
<?php endif; ?>

<?php if (Yii::$app->user->can('delete')): ?>
<h3>Can Delete</h3>
<?php endif; ?>

<?php var_dump(Yii::$app->user->can('guest')) ?>
