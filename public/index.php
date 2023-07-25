<?php

use App\Autoloader;
use App\Core\Main;

define('ROOT', dirname(__DIR__));
require_once ROOT . '/autoloader.php';
Autoloader::register();
$app = new Main();
// START APP
$app->start();
