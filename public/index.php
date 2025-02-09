<?php

// define - глобально объявленная константа
define('APP_PATH', dirname(__DIR__));

// Подключение autoloader
require_once APP_PATH . '/vendor/autoload.php';

use App\Kernel\App;

// использ. класса App
$app = new App(); // создание экземпляра класса
$app->run();






