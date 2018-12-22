<?php

use yii\helpers\Url;
use app\components\Help;
$this->title = "So'zlarni top o'yini";

?>
<?php if(isset($_POST['net'])) :?>
<!-- <div style="display: block;padding-right:17px" class="modal fade in" id="modal-id">
 -->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="savol text-success" style="font-size: 20px;font-weight: bold;">
          <?=$net?>
        </div>
      </div>
    </div>
  </div>
<!-- </div> -->
<?php else :?>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" id="yop" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
  <?php if($model!="Tugadi") :?>
    <?php if($javob==false) {?>
    <div class="modal-body">
      <div class="nomer">
       <?=$son?>-<?=Yii::t('app','savol')?>
      </div>
      <div id="ajaks"  class="savol">
      <?php for ($i=0; $i < count($word); $i++) { ?>
        <button class="bir1 btn hide<?=$i?>" son="hide<?=$i?>" tekst="<?=$word[$i]?>" count='<?=Help::strCount($word[$i],$model['work'])?>' ount='<?=Help::strCount($word[$i],$model['work'])?>' kount='1'>
        <?=$word[$i]?>
       </button>
      <?php }?>
       <div id="tekst" style="padding-top: 20px"><?=$work?></div>
       <!-- <div id="matn" content=''></div> -->
      </div>
      <form method="post" action="<?=Yii::$app->urlManager->createUrl("site/test")?>">
        <div class="javob">
          <input type="hidden" name="_csrf" value="LCAgxhTpal8Qw54pp-ahgF5z_GSEM0b1GKgy03tJyubvwfZJ1KFkn9-DMMnAJVfbtKFeD0ur-cwpmKLTxFwXQg==">
          <input type="hidden" id="model_id" value="<?=$model['id']?>" name="ok">
          <input type="hidden" id="info" name="word" value="">
        </div>

        <div class="tugmalar">
         <button id="next" style="display: none;" class="btn"><?=Yii::t('app','Tekshirish')?> </button>
         <a href='<?=Url::to(['site/test','id'=>$sled])?>' id="next2" style="" class="btn btn-default"><?=Yii::t('app','Keyingi')?> <?=Yii::t('app','savol')?></a>
        </div>
      </form>
    </div>
    <?php }else{ ?>
      <div class="modal-body">
      <div class="" style="padding-bottom: 30px">
       <?=$javob?>
      </div>
      <?php if($next==false) {?>
      <div id="ajaks"  class="savol">
      <?php for ($i=0; $i < count($word); $i++) { ?>
        <button class="bir1 btn hide<?=$i?>" son="hide<?=$i?>" tekst="<?=$word[$i]?>" count='<?=Help::strCount($word[$i],$model['work'])?>' ount='<?=Help::strCount($word[$i],$model['work'])?>' kount='1'>
        <?=$word[$i]?>
       </button>
      <?php }?>
       <div id="tekst" style="padding-top: 20px"><?=$work?></div>
       <!-- <div id="matn" content=''></div> -->
      </div>
      <form method="post" action="<?=Yii::$app->urlManager->createUrl("site/test")?>">
        <div class="javob">
          <input type="hidden" name="_csrf" value="LCAgxhTpal8Qw54pp-ahgF5z_GSEM0b1GKgy03tJyubvwfZJ1KFkn9-DMMnAJVfbtKFeD0ur-cwpmKLTxFwXQg==">
          <input type="hidden" id="model_id" value="<?=$model['id']?>" name="ok">
          <input type="hidden" id="info" name="word" value="">
        </div>

        <div class="tugmalar" style="padding-top: 20px">
          <?php if($next!=true){?><button id="next" style="display: none;" class="btn"><?=Yii::t('app','Tekshirish')?></button><?php }?>
        </div>
      </form>
      <?php }?>
      <a href='<?=Url::to(['site/test','id'=>$sled])?>' id="next2" style="" class="btn btn-default"><?=Yii::t('app','Keyingi')?> <?=Yii::t('app','savol')?></a>
    </div>
    <?php }?>
  <?php else :?>
    <div class="modal-body qism">
      <h4 class="hurmatli"><?=Yii::t('app','Xurmatli')?></h4>
      <h3><?=$user->ism." ".$user->familiya." ".$user->otchestvo?></h3>
      <div class="natija">
        <?=$javob?>.
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
<?php endif;?>
<?php
$url = Yii::$app->urlManager->createUrl('site/test');
$customScript = <<< JS
  $(function(){
    var a = 1;
    $(".bir1").click(function(e){
      $(".bir[status=aktiv]").eq(0).attr("status","no").html(strip_tags($(this).attr("tekst"))).addClass("btn btn-default k"+$(this).attr("son")).attr("id",$(this).attr("son"));
      if($(".bir[status=aktiv]").length==0){
        $("#next").show();
      }
      if($(this).attr('count')>1){
        if($(this).attr('ount')==$(".k"+$(this).attr("son")).length){
          $(this).hide();
        }
        $(this).attr('count',1*$(this).attr('count')-1).attr('kount',1*$(this).attr('kount')+1);
      }else{
        $(this).hide();
      }
      $("#info").val(strip_tags($("#tekst").html())); 
    });
    $("#tekst .ikki").click(function(e){
      $(this).html("...").attr("status","aktiv").removeClass("btn btn-default k"+$(this).attr('id'));
      $("."+$(this).attr('id')).show();
      $("#next").hide();
      if($("."+$(this).attr('id')).attr('kount')>1){
        $("."+$(this).attr('id')).attr('count',1*$("."+$(this).attr('id')).attr('count')+1).attr('kount',1*$("."+$(this).attr('id')).attr('kount')-1);
      }
    });
    function strip_tags(str) {
        return str.replace(/<\/?[^>]+(>|$)/g, "");
    }
    // $("#next").click(function(e){
    //   e.preventDefault();
    //   if($("#info").val()==$("#info2").val()){
    //     $("#ss").html("Ha");
    //   }else{
    //     $("#ss").html("Yoq");
    //   }

    // });
    $("#next").click(function(e){
      e.preventDefault();
      $("#ajaks").html("<img src='dist/image/ajax.gif'>");
      $.post('$url', {'ok':$("#model_id").val(),'word':$('#info').val()}, function(response){
          $("#modal-id").html(response);
      });
    });
    $("#next2").click(function(e){
      e.preventDefault();
      $("#modal-id").load($(this).attr("href"));
      $(this).parent().append("<img src='dist/image/ajax.gif'>");
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
?>