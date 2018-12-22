<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<body>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-lg-offset-2 col-md-4 col-sm-6 col-xs-12 tugmalar">
          <a href="<?=Yii::$app->urlManager->createUrl('site/index')?>">
            <h1>
            So'zni top o'yini
          </h1>
          </a>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 tugmalar">
        <?php if(Yii::$app->user->isGuest) : ?>
          <li class="big active list-unstyled"><a href="<?=Yii::$app->urlManager->createUrl('site/login')?>"><?=Yii::t('app','KIRISH')?></a></li>
          <li class="big2 list-unstyled"><a href="<?=Yii::$app->urlManager->createUrl('site/reg')?>"><?=Yii::t('app','Ro\'yxatdan o\'tish')?></a></li>
        <?php else :?>
          <li class="big active list-unstyled"><a href="<?=Yii::$app->urlManager->createUrl('site/profil')?>"><?=Yii::t('app','Profil')?></a></li>
          <li class="big2 list-unstyled">
            <?=Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    Yii::t("app","Chiqish").' (' . Yii::$app->user->identity->login . ')',
                    ['class' => 'btn btn-link logout chiq']
                )
                . Html::endForm()
            ?>
          </li>
        <?php endif;?>
        </div> <!-- //tugmalar -->
      </div> <!-- //row -->
    </div> <!-- //container -->
  </header>

  <div class="mainly">
    <div class="container">
      
      <?=$content?>

    </div> <!-- //container -->
  </div> <!-- //mainly -->

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          
        </div>  
      </div>
    </div>
  </footer>
  <div class="oxiri"></div>

<?php 
    // $url = 'madrasa/dist/js/jquery.scrollTo-min.js';
    $url2 = Yii::$app->urlManager->createUrl('dist/js/toucheffects.js');
    $url3 = Yii::$app->urlManager->createUrl('dist/js/jquery-ui.js');
    // $url4 = 'madrasa1/dist/js/harita.js';
    // $url5 = 'madrasa/dist/js/funk.js';
    // $url6 = 'madrasa/dist/js/slimbox2.js';
    $url1 = Yii::$app->urlManager->createUrl('dist/js/jQuery.js');
    $url7 = Yii::$app->urlManager->createUrl('dist/js/bootstrap.min.js');
    $url8 = Yii::$app->urlManager->createUrl('dist/js/jquery.cookie.js');
    $this->registerJsFile($url1);
    // $this->registerJsFile($url, ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerJsFile($url2, ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerJsFile($url3, ['depends' => [\yii\web\JqueryAsset::className()]]);
    // $this->registerJsFile($url4, ['depends' => [\yii\web\JqueryAsset::className()]]);
    // $this->registerJsFile($url5, ['depends' => [\yii\web\JqueryAsset::className()]]);
    // $this->registerJsFile($url6, ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerJsFile($url7, ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerJsFile($url8, ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
