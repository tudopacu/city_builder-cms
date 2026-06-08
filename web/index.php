<?php

// comment out the following two lines when deployed to production
// in index.php or your entry script
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// Update these lines at the top of the file to trust system environment variables
defined('YII_DEBUG') or define('YII_DEBUG', isset($_ENV['YII_DEBUG']) ? (bool)$_ENV['YII_DEBUG'] : false);
defined('YII_ENV') or define('YII_ENV', isset($_ENV['YII_ENV']) ? $_ENV['YII_ENV'] : 'prod');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
