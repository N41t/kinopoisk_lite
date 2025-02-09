<?php

namespace App\Router;

// Класс для описания свойств маршрута
class Route
{

    // создание и объясвление переменных осуществляем непосредственно в конструкторе (PHP-8.0)
    public function __construct(
        private string $uri,
        private string $method,
        private $action
    ) {}


    // метод создает объект класса себя, указывая метод get и возвращая обратно
    public static function get(string $uri, $action): static
    {
        return new static($uri, 'GET', $action);
    }

    public static function post(string $uri, $action): static
    {
        return new static($uri, 'POST', $action);
    }


    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }

}