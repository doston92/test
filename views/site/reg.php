<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<div class="site-reg col-lg-offset-2 col-lg-8">


    <?php $form = ActiveForm::begin(); ?>
    	<div>
	        <span style="float: left;"><?= $form->field($model, 'login')->textInput(['maxlenth' => true,'id'=>'login']) ?></span>
			<span id="bor" class="btn" style="color: green; margin-top: 20px"></span>
		</div>
		<div style="clear: both;"></div>
		<div class="kor">
	        <span style="float: left;"><?= $form->field($model, 'parol')->textInput(['maxlenth' => true]) ?>
			</span>
			<span class="btn borr" style="color: green; margin-top: 20px"></span>
		</div>
		<div style="clear: both;"></div>
	    <div class="kor">
	        <span style="float: left;"><?= $form->field($model, 'ism')->textInput(['maxlenth' => true]) ?></span>
			<span class="btn borr" style="color: green; margin-top: 20px"></span>
		</div>
		<div style="clear: both;"></div>
		<div class="kor">
	        <span style="float: left;"><?= $form->field($model, 'familiya')->textInput(['maxlenth' => true]) ?></span>
			<span class="btn borr" style="color: green; margin-top: 20px"></span>
		</div>
		<div style="clear: both;"></div>
		<div class="kor1">
	        <span style="float: left;"><?= $form->field($model, 'otchestvo')->textInput(['maxlenth' => true]) ?></span>
			<span class="btn borr" style="color: green; margin-top: 20px"></span>
		</div>
		<div style="clear: both;"></div>
        <div class="kor1">
	        <span style="float: left;"><?= $form->field($model, 'image')->fileInput() ?></span>
			<span class="btn borr" style="color: green; margin-top: 20px"></span>
		</div>
		<div style="clear: both;"></div>
        <div class="kor">
	        <span style="float: left;"><?= $form->field($model, 'jins')->dropDownList([ 'erkak' => 'Erkak', 'ayol' => 'Ayol', ], ['prompt' => '']) ?></span>
			<span class="btn borr" style="color: green; margin-top: 20px"></span>
		</div>
		<div style="clear: both;"></div>
    
        <div class="form-group">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary','id'=>'jonat']) ?>
            <span id="kontent"></span>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-reg -->
<?php
$url = Yii::$app->urlManager->createUrl('site/reg1');
$poisk = Yii::$app->urlManager->createUrl('dist/image/ajax.gif');
$script2 = <<< JS
 $(document).ready(function(){
	$("input,select").css("width","400px");
      $("#login").blur(function(e){
      	// alert($("#login").val());
        e.preventDefault();
        if($("#login").val()!=""){
	        $("#bor").html("<img src=\"$poisk\" width=\"20px\">");
	        $.post('$url', {'bor':$("#login").val()}, function(response){
	            $("#bor").html(response);
	            if($("#javob").html()==1){
	            	$("#login").css("background","red");
	            }else{
	            	$("#login").css("background","ivory");
	            }      
	        });
	    }
      });
      $(".kor input,select").blur(function(e){
      	// alert($(this).val());
        e.preventDefault();
        if($(this).val()!=""){
	        // alert($(this).parent().parent().next().html());
	        $(this).parent().parent().next().html("<span style='font-size:20px'>&#10004;</span>");
	    }else{
	    	$(this).parent().parent().next().html("<div style='color:red;background:ivory;padding:5px'>To'ldirish majburiy!</div><div style='display:none' id='javob'>1</div>");
	    	if($(this).attr("type")=="file"){
	    		$(this).parent().parent().next().html("<span style='font-size:16px;color:green'>To'ldirish majburiy emas</span>");
	    	}
	    }
	    var test = /^[\d]{4}$/;
      	if(!test.exec($("#god").val()) && $("#god").val()!=""){
	        $("#god").parent().parent().next().html("<div style='color:red;background:ivory;padding:5px'>Yilni quyidagicha kiritish lozim, M: 2017</div>");
	    }
      }); 
     $("#jonat").click(function(e){
     	if($("#javob").html()==1){
        	e.preventDefault();
        	alert("Iltimos,Boshqa login tanlang!")
        }
     })
 });
JS;
    $this->registerJS($script2, yii\web\View::POS_END);
?> 
