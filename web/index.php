<?php

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
defined('DS')              or define('DS', DIRECTORY_SEPARATOR);

// change the following paths if necessary
$yii=dirname(__FILE__) . DS . '../vendors' . DS . 'yii-framework' . DS . 'yii.php';
$config=dirname(__FILE__) . DS . '..'  . DS . 'protected' . DS . 'config' . DS . 'main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
