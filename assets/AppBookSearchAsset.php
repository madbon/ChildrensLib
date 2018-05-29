<?php
/**
 * Created by PhpStorm.
 * User: levibeverly
 * Date: 28/10/2017
 * Time: 11:22 AM
 */

namespace app\assets;

use yii\web\AssetBundle;

class AppBookSearchAsset extends AssetBundle
{
    // MARK: - Base url
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    // MARK: - css properties
    public $css = [
                    'template/vendor/bootstrap/css/bootstrap.min.css',
                    'template/vendor/font-awesome/css/font-awesome.min.css',
                    'https://fonts.googleapis.com/css?family=Asap',
                    'css/lightslider.css',
                    'css/custom-modal.css',
                    'css/viewer.css',
                    'css/prettify.css',
                  ];

    public $js = [
                    'js/jquery.min.js',
                    'template/vendor/bootstrap/js/bootstrap.min.js',
                    'js/angular.js',
                    'js/browse.js',
                    'js/lightslider.js',
                    'js/bookdesc.js',
                    'js/viewer.js',
                    'js/prettify.js',    
                    'js/jquery.slimscroll.js'
                 ];

}