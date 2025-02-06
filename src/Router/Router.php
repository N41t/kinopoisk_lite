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

    // обрабатывает маршрут
    public function dispatch(string $url, string $method): void
    {
        // находим маршрут по переданным параметрам
        $route = $this->findRoute($url, $method);

        // проверка найден ли маршрут
        if (!$route) {
            $this->notFound();
        }

        // если маршрут найден
        $route->getAction()(); // после получения данных из метода getAction(), полученный метод вызывается автоматич. (самовызывающаяся функция)

    }

    // вывод ошибки при ненахождении маршрута
    private function notFound(): void {
        echo '404 | Not Found';
        exit;
    }


    // находит маршрут в общем списке по заданным параметрам (return false если маршрут не найден)
    private function findRoute(string $url, string $method): Route|false {
        if (isset($this->routes[$method][$url]) === false) {
            return false;
        }

        return $this->routes[$method][$url];
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