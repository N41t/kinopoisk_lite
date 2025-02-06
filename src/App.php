<?php

namespace App;

use App\Router\Router;

class App
{
    public function run(): void
    {
        $router = new Router();

        // получение пути из адреса
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $router->dispatch($url, $method);
    }
}