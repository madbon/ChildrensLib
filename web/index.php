<?php

// comment out the following two lines when deployed to production

if (!defined('APPLICATION_ENV'))
{
 if (getenv('APPLICATION_ENV') != false)
 define('APPLICATION_ENV',
 getenv('APPLICATION_ENV'));
 else
 define('APPLICATION_ENV', 'dev');
}


defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', APPLICATION_ENV);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');



(new yii\web\Application($config))->run();
