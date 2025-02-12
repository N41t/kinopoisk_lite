<?php

namespace App\Kernel\Router;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\View\View;

class Router
{

    // массив для хранения определенных групп маршрутов
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];


    public function __construct(
        private View $view,
        private Request $request,
        private Redirect $redirect
    )
    {
        $this->initRoutes();
    }

    // обрабатывает маршрут
    public function dispatch(string $uri, string $method): void
    {
        // находим маршрут по переданным параметрам
        $route = $this->findRoute($uri, $method);

        // проверка найден ли маршрут
        if (!$route) {
            $this->notFound();
        }

        // для поддержки action-ов контроллеров
        // Если action является массивом, это значит что передаем контроллер
        if (is_array($route->getAction())) {
            // получение пути до контроллера + action
            [$controller, $action] = $route->getAction();

            // создание экземпляра класса контроллера который взаимодействует с данным маршрутом
            /** @var Controller $controller */
            $controller = new $controller();

            // внедрение через метод абстрактного контроллера наших сервисов
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);

            // вызов метода контроллера
            call_user_func([$controller, $action]);
        } else {
            // для тех вариантов, когда передаем анонимную функцию в routes вместо контроллеров и action-ов
            // если маршрут найден
            call_user_func($route->getAction());
        }



    }

    // вывод ошибки при ненахождении маршрута
    private function notFound(): void {
        echo '404 | Not Found';
        exit;
    }


    // находит маршрут в общем списке по заданным параметрам (return false если маршрут не найден)
    private function findRoute(string $uri, string $method): Route|false {
        if (isset($this->routes[$method][$uri]) === false) {
            return false;
        }

        return $this->routes[$method][$uri];
    }


    // расфасовывает маршруты из файла routes.php по группам
    private function initRoutes() {

        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
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