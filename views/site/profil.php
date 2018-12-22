<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<?php if (!isset($_GET['edit']) && !isset($_GET['delete'])): ?>
  <?php if(!Yii::$app->user->isGuest) : ?>
  <div class="asosiy bg-success">
    <div class="kontiner">
        <div class="row">
            <div class="col-lg-3 chap">
                
            </div>
            <div class="col-lg-8 urta padding bg-warning">
                <div class="margin padding bg">
                    <span class="avatar-span">
                       <img style="border-radius: 100px;width: 100px" class="avatar" src="<?=Yii::$app->urlmanager->createUrl($model->image)?>">
                    </span>
                    <span style="color: green;font-size: 20px">
                        <?=$model->ism; ?> <?=$model->familiya; ?> <?=$model->otchestvo; ?>
                    </span>
                    <br>
                </div>
                <div class="margin">
                    <ul style="color: indigo;font-size: 15px" class="list-group">
                       <li class="list-group-item text-center">
                         Ism: <span><?=$model->ism; ?></span>
                       </li>
                        <li class="list-group-item text-center">
                          Familiya: <span><?=$model->familiya; ?></span>
                        </li>
                        <li class="list-group-item text-center">
                          Otchestvo: <span><?=$model->otchestvo; ?></span>
                        </li>
                        <li class="list-group-item text-center">
                          Jins: <span><?=$model->jins; ?></span>
                        </li>
                        <li class="list-group-item text-center">
                          To'plagan ballari: <span><?=$model->bal; ?></span>
                        </li>
                        <li class="list-group-item text-center">
                          Ro'yxatdan o'tgan vaqti: <span><?=Datetime::createFromFormat('Y-m-d H:i:s', $model->created_time)->format('d/m/Y');?></span>
                        </li>
                        <?php if(!isset($_GET['id'])):?>
                        <li class="list-group-item text-center"><a class="btn-default btn-lg text-none" href="<?=Yii::$app->urlmanager->createUrl(['site/profil','edit'=>Yii::$app->user->identity->id])?>">Anketani o`zgartirish</a></li>
                        <li class="list-group-item btn btn-default text-none btn-lg" type="button" data-toggle="modal" data-target="#myModal">Anketani o`chirish</li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-1 ung">
                
            </div>
        </div>
    </div>
                <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Rostdan ham anketangizni o`chirmoqchimisiz?</h4>
                          </div>
                          <div class="modal-body text-center">
                            <a href="<?=Yii::$app->urlmanager->createUrl(['site/profil','delete'=>Yii::$app->user->identity->id])?>" type="button" class="btn btn-primary btn-lg">Ha</a>
                            <br>
                            <a type="button" class="btn btn-success btn-lg" data-dismiss="modal">Yo`q</a>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Yopish</button>
                          </div>
                        </div>
                      </div>
                    </div>

</div> <!-- //Asosiy tugadi -->
<?php endif;?>
<?php endif;?>
<?php if (isset($_GET['edit'])): ?>
  <?php 
    $form = ActiveForm::begin([
    'options' => [
      'enctype' => 'multipart/form-data'
    ]
    ]);?>
  <?=$form->field($model, 'id')->hiddenInput(['value'=>$_GET['edit']])->label("")?>
  <?=$form->field($model, 'login')->textInput(['disabled'=>""])?>
  <?=$form->field($model, 'parol')->hiddenInput()->label("")?>
  <?=$form->field($model, 'ism')->textInput(['placeholder'=>'Ismingizni kiriting...', 'value'=>$model->ism])->label('Ism')?>
  <?=$form->field($model, 'familiya')->textInput(['value'=>$model->familiya])?>
  <?=$form->field($model, 'otchestvo')->textInput(['value'=>$model->otchestvo])?>
  <input type="hidden" name="vaqt" value="$model->vaqt">
  <input type="hidden" name="rasm" value="<?=$model->image?>">
  <?=$form->field($model, 'image')->fileInput(['class'=>'btn btn-sucses'])->label('Faylni tanlang')?>
  <?= $form->field($model, 'jins')->dropDownList(['Erkak'=>'Erkak','Ayol'=>'Ayol'])?>
                   
  <?=Html::submitInput('Jo`natish',['class'=>'btn btn-default'])?>

  <?php ActiveForm::end();?>
<?php endif;?>
<!-- <?php if (isset($_GET['delete'])): ?>
  <?php 
    $form = ActiveForm::begin([
    'options' => [
      'enctype' => 'multipart/form-data'
    ]
    ]);?>
  <?=$form->field($model, 'id')->hiddenInput(['value'=>$model->id])->label("")?>
  <?=$form->field($model, 'amal')->hiddenInput(['value'=>"delete"])->label("")?>
  <h2>Rostdan ham <b><font color='Blue'><?=$model->ism?></font></b> nomli foydalanuvchini o'chirmoqchimisiz?</h2>
                   
  <?=Html::submitInput('Ha',['class'=>'btn btn-default'])?><a href="<?=Yii::$app->urlmanager->createUrl('site/profil')?>" class="btn btn-default">Yo'q</a>

  <?php ActiveForm::end();?>
<?php endif;?> -->
<?php
$url = Yii::$app->urlManager->createUrl('site/reg1');
$basc = Yii::$app->urlmanager->createUrl('rasm/bg.jpg');
$customCss = <<< CSS
  li span{
    color: green!important;
    font-size: 20px
  }
  .wrap{
        padding: 0;
        margin: 0;
        width: 100%
    }
    .kon{
        width: 100%;
        padding: 0!important;
        margin: 0;
    }
    .modal-body a{
      color: ivory
    }
    .modal-body a:hover{
      color: indigo;
      background: ivory
    }

CSS;
$this->registerCss($customCss);
