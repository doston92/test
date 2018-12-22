<?php

use yii\helpers\Url;
$this->title = "So'zlarni top o'yini";

?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 paddingsiz news">

    <div class="col-md-8 col-sm-10 col-xs-12 paddingsiz test" style="width: 60%;margin-left: 20%">
      <div class="sarlavha2 uch col-md-12 col-xs-12">
        <?=Yii::t('app','Onlayn test')?>
        <img src="dist/image/burchak1.png" class="burchak1" style="left: -2.2%">
        <img src="dist/image/burchak2.png" class="burchak2" style="right: -2.5%">
      </div>
      <div class="col-md-12 col-xs-12 begin">
        <h5><?=Yii::t('app','O‘Z BILIMINGIZNI SINAB KO‘RING!')?></h5>
        <button data-toggle="modal" href='#modal-id' id="start" class="btn korish">
         <a><span class="glyphicon glyphicon-check"></span> <?=Yii::t('app','TESTNI BOSHLASH')?> </a>
        </button>
        <div class="reyting"><?=Yii::t('app','REYTING')?></div>
        <?php foreach ($talaba as $key): ?>
        <div class="col-md-12 col-xs-12 winners paddingsiz">
          <div class="col-md-3 col-sm-12 col-xs-12 img_winner">
            <img src="<?=$key->image?>">
          </div>
          <div class="col-md-7 col-sm-12 col-xs-12 malumoti">
          <a class="korish" href="<?=Url::to(['site/profil','id'=>$key->id])?>">
            <div class="ism"><?=$key->ism." ".$key->familiya?></div>
          </a>
          </div>
          <div class="col-md-2 col-sm-12 col-xs-12 ochko">
            <?=$key->bal?>
          </div>
        </div>
        <?php endforeach;?>
        <button class="btn" data-toggle="modal" href='#umumiy_reyting'>
          <a> 
            <?=Yii::t('app','Umumiy reyting')?>
          </a>
        </button>
      </div>
    </div>
  </div><!--  //news -->
</div> <!-- //row -->
<?php if(!Yii::$app->user->isGuest) : ?>
  <div class="modal fade" id="modal-id">
    <div class="modal-dialog">
      <div class="modal-content">
       
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
      <?php if($model!="Tugadi") :?>
        
      <?php else :?>
        <div class="modal-body qism">
          
         <div id="notugri" class="tugmalar" style="display: block; float: none;">
           <button class="btn btnn tugmacha" data-dismiss="modal" aria-hidden="true" style="color: #ccc"><?=Yii::t('app','Chiqish')?></button>
         </div>

         <div>
           <!-- <a href="#">Bosh sahifaga qaytish</a> -->
         </div>

        </div>
      <?php endif;?>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div> <!-- // Test modal tugadi -->
<?php endif;?>
  <div class="modal fade" id="umumiy_reyting">
    <div class="modal-dialog">
      <div class="modal-content" style="width: 400px; padding-right: 25px">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            <div class="sarlavha2 uch col-md-12 col-xs-12" style="text-align: center;border: 2px solid rgb(252, 229, 1);">
              <?=Yii::t('app','Umumiy reyting')?>
            </div>
            <div class="col-md-12 col-xs-12 text-center"> 
              <?php foreach ($talaba_umumiy as $key): ?>
              <div class="col-md-12 col-xs-12 winners paddingsiz">
                <div class="col-md-3 col-sm-12 col-xs-12 img_winner">
                  <img src="<?=$key->image?>">
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12 malumoti">
                  <a class="korish" href="<?=Url::to(['site/profil','id'=>$key->id])?>"><div class="ism"><?=$key->ism." ".$key->familiya?></div></a>
                </div>
                <div class="col-md-2 col-sm-12 col-xs-12 ochko">
                  <?=$key->bal?>
                </div>
              </div>
              <?php endforeach;?>
              <button class="btn btnn text-center" data-toggle="modal" href='#umumiy_reyting'>
                <a> 
                  <?=Yii::t('app','Chiqish')?>
                </a>
              </button>
            </div>
          </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div> <!-- //Umumiy reyting tugadi -->
<?php
$url = Yii::$app->urlManager->createUrl('site/test');
$customScript = <<< JS
  $(function(){
    $("#junat").click(function(e){
      e.preventDefault();
      $("#ajaks").html("<img width='40px' src='dist/image/ajax.gif'>");
      $.post('$url', {'son':$("#model_id").val(),'ok':$('input[name=ok]:checked').val()}, function(response){
                $.cookie('test', (1*$("#model_id").val())+1, {
                  expires: 500
                });
                $("#modal-id").html(response);
            });
    });
    $("#net").click(function(e){
      e.preventDefault();
      // alert($("#model_id").val()+' '+"$url");
      // alert($('input[name=ok]:checked').val());
      $("#notugri").html("<span class='btn tugmacha' style='color:green;font-size:18px;font-weight:bold'>"+$.cookie('net')+"</span");
      $.cookie('net','Noto`g`ri javoblar: ');
      });
  });
JS;
$this->registerJs($customScript, \yii\web\View::POS_READY);
if(Yii::$app->user->isGuest){
$korish = <<< JS
    $("#start").click(function(e){
      e.preventDefault();
      alert("Avval saytga kiring yoki ro'yhatdan o'ting!");
      window.location = "site/login";
    });
JS;
  
}else{
$korish = <<< JS
    $("#start").click(function(e){
      e.preventDefault();
      $("#modal-id").load("$url");
    });
JS;
}
$this->registerJs($korish, \yii\web\View::POS_READY);
?>