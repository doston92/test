<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\models\Word */

$this->title = Yii::t('app', '{modelClass} o`zgartirish: ', [
    'modelClass' => 'Word',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Words'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'O`zgartirish');
?>
<div class="word-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>