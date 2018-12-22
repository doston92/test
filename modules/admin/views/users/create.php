<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\models\Users */

$this->title = Yii::t('app', 'Users qo`shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
     ]) ?>

</div>
