<?php

namespace App\Router;

class Router
{
    public function dispatch(string $url): void
    {
        // получение всех маршрутов
        $routes = $this->getRoutes();

        // вызываем функцию по необходимому uri
        $routes[$url]();
    }

    private function getRoutes(): array
    {
        return require_once APP_PATH . '/routes/routes.php';
    }
}