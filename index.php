<?php

// define - глобально объявленная константа
define('APP_PATH', __DIR__);

// Подключение autoloader
require_once APP_PATH.'/vendor/autoload.php';

// получение всех маршрутов
$routes = require_once APP_PATH.'/routes/routes.php';
// получение пути из адреса
$uri = $_SERVER['REQUEST_URI'];
// вызываем функцию по необходимому uri
$routes[$uri]();




