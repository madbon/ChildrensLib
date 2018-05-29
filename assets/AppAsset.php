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
        'css/site.css',
        'template/vendor/bootstrap/css/bootstrap.min.css',
        'template/vendor/metisMenu/metisMenu.min.css',
        'template/dist/css/sb-admin-2.css',
        'template/vendor/font-awesome/css/font-awesome.min.css',
        'color_picker/css/colorpicker.css',
        'bootstrap-chosen-master/bootstrap-chosen.css',
        'css/detailview_custom.css',
    ];  
    public $js = [
        // 'template/vendor/jquery/jquery.min.js',
        'template/vendor/bootstrap/js/bootstrap.min.js',
        'template/vendor/metisMenu/metisMenu.min.js',
        'template/dist/js/sb-admin-2.js',
        'color_picker/js/colorpicker.js',
        'color_picker/js/eye.js',
        'color_picker/js/utils.js',
        'bootstrap-chosen-master/chosen.jquery.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}

