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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'dist/style/stil.css',
        'dist/css/slimbox2.css',
        'dist/css/jquery.fancybox.css',
        'dist/css/ajax.css'
    ];
    public $js = [
        // 'dist/js/jQuery.js',
        // '',
        // 'dist/js/jquery.cookie.js',
        // '',
        // 'dist/js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
