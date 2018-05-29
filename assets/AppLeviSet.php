<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppLeviSet extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'template/vendor/bootstrap/css/bootstrap.min.css',  
        'template/dist/css/sb-admin-2.min.css'
    ];  
    public $js = [
        'js/jquery.min.js',
        'template/vendor/bootstrap/js/bootstrap.min.js',
        'template/dist/js/sb-admin-2.min.js',
        'js/jquery.bootpag.min.js',
        'js/pagination.js'

    ];
    public $depends = [];
}


?>