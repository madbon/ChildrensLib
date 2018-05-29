<?php
/**
 * Created by PhpStorm.
 * User: levibeverly
 * Date: 28/10/2017
 * Time: 12:27 PM
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppBookSearchAsset;

AppBookSearchAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="browseApp">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css" media="screen">
        // TODO: - css styling
        .arrow {
               -o-transition:color .2s ease-out, background 1s ease-in;
               -ms-transition:color .2s ease-out, background 1s ease-in;
               -moz-transition:color .2s ease-out, background 1s ease-in;
               -webkit-transition:color .2s ease-out, background 1s ease-in;
               }
        .arrow:hover {  color: #000000 !important;  }

        .button {
                padding: 15px 25px;
                font-size: 24px;
                text-align: center;
                cursor: pointer;
                outline: none;
                border: none;
                border-radius: 15px;
                box-shadow: 0 9px #999;
              }

        .button:hover {background-color: #3e8e41}

        .button:active {
          background-color: #3e8e41;
          box-shadow: 0 5px #666;
          transform: translateY(4px);
        }

        .loader {
          border: 16px solid #f3f3f3;
          border-radius: 50%;
          border-top: 16px solid #3498db;
          width: 120px;
          height: 120px;
          -webkit-animation: spin 2s linear infinite; /* Safari */
          animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }

        .btn-group .btn-fab {
          position: fixed !important;
          right: 40px;
        }

        .btn.btn-fab {
          border-radius: 100%;
          border-top-left-radius: 100%;
          border-top-right-radius: 100% !important;
          border-bottom-right-radius: 100% !important;
          border-bottom-left-radius: 100%;
        }

        #main{
          font-size: 50px;
          top: 100px;
        }

        #default {
          font-size: 50px;
          top: 200px;
        }

    </style>
</head>
<body style="background-image: url('/childrenslibrarywithyii/web/images/bg_clouds.png'); background-repeat: repeat-x;  background-position: 50% 0;">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



