<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\models\Word */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="word-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'work')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'word')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bal')->textInput(['value'=>1]) ?>

    <?= $form->field($model, 'view')->hiddenInput(['value'=>0])->label(false) ?>

    <?= $form->field($model, 'created_time')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'faol' => 'Faol', 'nofaol' => 'Nofaol', ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Saqlash') : Yii::t('app', 'O`zgartirish'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
