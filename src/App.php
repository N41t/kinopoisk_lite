<?php

namespace App;

use App\Http\Request;
use App\Router\Router;

class App
{
    public function run(): void
    {
        $router = new Router();

        // объявление запроса
        $request = Request::createFromGlobals();

        // получение пути из адреса
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $router->dispatch($request->uri(), $request->method());
    }
}