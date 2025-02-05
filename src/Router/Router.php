<?php

namespace App\Router;

class Router
{

    // массив для хранения определенных групп маршрутов
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];


    public function __construct()
    {
        $this->initRoutes();
    }

    public function dispatch(string $url): void
    {
        // получение всех маршрутов
        $routes = $this->getRoutes();

        // вызываем функцию по необходимому uri
        $routes[$url]();
    }

    // расфасовывает маршруты из файла routes.php по группам
    private function initRoutes() {

        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUrl()] = $route;
        }

    }

    // получает массив всех маршрутов
    // @return -> явно показывает что возвращаем массив из роутов

    /**
     * @return Route[]
     */
    private function getRoutes(): array
    {
        return require_once APP_PATH . '/routes/routes.php';
    }
}