<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div id="error" class="section">
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
</div>
</div>
<?php 
$customScript = <<< JS
    $("#bosh .thumb a").click(function(){
            window.location = "index/"+$(this).attr("href");
        });
JS;
$this->registerJs($customScript, \yii\web\View::POS_READY);
