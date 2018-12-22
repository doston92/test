<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\models\Users */

$this->title = Yii::t('app', '{modelClass} o`zgartirish: ', [
    'modelClass' => 'Users',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'O`zgartirish');
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
