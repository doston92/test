<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'adminka/css/admin.css',
        'adminka/bower_components/font-awesome/css/font-awesome.min.css',
        'adminka/bower_components/Ionicons/css/ionicons.min.css',
        'adminka/css/AdminLTE.min.css',
        'adminka/css/skins/_all-skins.min.css',
    ];
    

    public $js = [
        'dist/js/bootstrap.min.js',
        'adminka/js/bower_components/jquery-ui/jquery-ui.min.js',
        'adminka/js/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'adminka/js/adminlte.min.js',
        // 'dist/js/pages/dashboard.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}