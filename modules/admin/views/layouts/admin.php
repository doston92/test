<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

AdminAsset::register($this);
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
    <link rel="favicon icon" href="dist/image/bayroq-gerb.png">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<?php if (!Yii::$app->user->isGuest) : ?>
  <?php if (Yii::$app->user->identity->id=='1') : ?>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=Yii::$app->urlManager->createUrl('admin')?>" class="logo fixed">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><span class="glyphicon glyphicon-arrow-right" data-toggle="push-menu"></span></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" data-toggle="push-menu"><b>Admin</b>ka</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-fixed-top">
      <!-- Sidebar toggle button-->
      <span href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class=" glyphicon glyphicon-arrow-left"></span>
      </span>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=Yii::$app->urlManager->createUrl(Yii::$app->user->identity->image)?>" class="user-image" alt="User Image">
              <span class="hidden-xs">
              	<?=Yii::$app->user->identity->ism; ?>
                <?=Yii::$app->user->identity->familiya; ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=Yii::$app->urlManager->createUrl(Yii::$app->user->identity->image)?>" class="img-circle" alt="User Image">

                <p>
                  
                  <b><?=Yii::$app->user->identity->ism; ?>
                  <?=Yii::$app->user->identity->familiya; ?></b> - Sayt Admini
                  <small>Ro'yxatdan o'tgan vaqti: <?=Yii::$app->user->identity->created_time?></small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=Yii::$app->urlManager->createUrl('admin/users/view?id='.Yii::$app->user->identity->id)?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <?= Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Chiqish',
                        ['class' => 'btn btn-primary']
                    )
                    . Html::endForm()
                  ?>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="padding-top: 130px">
      <!-- Sidebar user panel -->
      <div class="user-panel fixed" style="padding-left: 2px; top: 60px; width: 230px">
        <div class="pull-left image">
          <img src="<?=Yii::$app->urlManager->createUrl(Yii::$app->user->identity->image)?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
            <?=Yii::$app->user->identity->ism; ?>
            <?=Yii::$app->user->identity->familiya; ?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form fixed" style="top: 120px">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Admin panel</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Sahifalar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?=Yii::$app->urlManager->createUrl('admin/users')?>"><i class="fa fa-circle-o"></i> Foydalanuvchilar</a>
            </li>
            <li>
              <a href="<?=Yii::$app->urlManager->createUrl('admin/word')?>">
                <i class="fa fa-circle-o"></i> Savollar
              </a>
            </li>
          </ul>
        </li> 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?=$content?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2017 <a href="https://usayt.uz">Usayt.uz</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->
<?php else : ?>
  <div class="btn btn-default text-center col-lg-offset-2">
    <h1>Kechirasiz, siz bu hizmatdan foydalana olmaysiz!!!</h1>
    <?= Html::beginForm(['/site/logout'], 'post')
      . Html::submitButton(
          'Chiqish',
          ['class' => 'btn btn-primary']
      )
      . Html::endForm()
    ?>
  </div>
<?php endif; ?>
<?php endif; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>