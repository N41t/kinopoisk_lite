<?php

// Подключение autoloader
require_once __DIR__.'/vendor/autoload.php';

// получение всех маршрутов
$routes = require_once __DIR__.'/routes/routes.php';
// получение пути из адреса
$uri = $_SERVER['REQUEST_URI'];
// вызываем функцию по необходимому uri
$routes[$uri]();




