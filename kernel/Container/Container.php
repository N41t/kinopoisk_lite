<?php

namespace App\Kernel\Container;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;

class Container
{
    public readonly Request $request;

    public readonly Router $router;


    public function __construct()
    {
        //вызываем регистрацию сервисов в конструкторе контенйер-класса
        $this->registerServices();
    }


    private function registerServices(): void
    {
        // объявление запроса
        $this->request = Request::createFromGlobals();

        $this->router = new Router();

    }
}