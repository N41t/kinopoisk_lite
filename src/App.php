<?php

namespace App;

class App
{
    public function run(): void
    {
        // получение всех маршрутов
        $routes = require_once APP_PATH . '/routes/routes.php';
        // получение пути из адреса
        $url = $_SERVER['REQUEST_URI'];
        // вызываем функцию по необходимому uri
        $routes[$url]();
    }
}