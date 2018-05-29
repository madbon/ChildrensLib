<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/3/17
 * Time: 5:34 AM
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppBookSearchAsset;

AppBookSearchAsset::register($this);

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
    <style type="text/css" media="screen">
        .content-slider li, .main-slider li{
            background-color: #aaa; 
            text-align: center;
        }
        .content-slider h3, .main-slider div {
            margin: 0;
        }

        .content-slider {
            margin: 0 auto;
        }

        .content-slider li {
            display: inline-block;
            width: 20%;
        }


        .content-slider li:hover {
            opacity: 0.5;
        }

        .content-slider div {
            padding: 0;
            display: inline-block;
        }

        .content-slider div img {
            height: 150px;
            width: 70%;
        }

        .main-slider div {
            padding: 70px 0;
            height: 500px;
        }

        .bookcover {
            width: 50%;
            margin: 0 auto;
            cursor: pointer;
        }

        .bookcover img {
            width: 100%;
        }


        .bookcoverdescription, .bookcover {
            height: 300px;
        }

        .bookcoverdescription {
          overflow-y: auto;
        }

        .bookcoverdescription h1 {
            text-align: center;
        }

        .bookcoverdescription p {
            text-indent: 50px;
            text-align: justify;
        }

        .both-side-description table tr td:first-child {
            text-align: right;
        }

        .both-side-description table tr td:last-child {
            text-indent: 20px;
        }

        #overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;

            z-index: 2;
            cursor: pointer;
             overflow-y: auto;
             z-index: 1000;
        }

        #text {
            margin: 0 auto;
            margin-top: 3%;
            width: 80%;
        }

        .showDiv {
            display: block !important;
        }
        

        .middle {
          transition: .5s ease;
          opacity: 0;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
          text-align: center;
        }

        .bookcover-container:hover .image {
          opacity: 0.3;
        }

        .bookcover-container:hover .middle {
          opacity: 1;
        }

        .text {
          background-color: #4CAF50;
          color: white;
          font-size: 16px;
          padding: 16px 32px;
          cursor: pointer;
        }


        .vSAction > .vSPrev {
            background-position: 0 0;
            left: 10px;
            background-image: url(../../images/icons8-chevron-left-100.png);
        }

        .vSAction > .vSNext {
            background-position: -100px 0;
            right: 10px;
            background-image: url(../../images/icons8-chevron-right-100.png);
        }

        .vSAction > a {
            width: 100px;
            display: block;
            top: 40%;
            height: 100px;
            cursor: pointer;
            position: absolute;
            z-index: 99;
            margin-top: -16px;
            opacity: 0.5;
            -webkit-transition: opacity 0.35s linear 0s;
            transition: opacity 0.35s linear 0s
        }

        .vSAction > a:hover {
            opacity: 1;
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

