<?php

namespace App\Router;

// Класс для описания свойств маршрута
class Route
{

    // создание и объясвление переменных осуществляем непосредственно в конструкторе (PHP-8.0)
    public function __construct(
        private string $url,
        private string $method,
        private $action
    ) {}


    // метод создает объект класса себя, указывая метод get и возвращая обратно
    public static function get(string $url, $action): static
    {
        return new static($url, 'GET', $action);
    }

    public static function post(string $url, $action): static
    {
        return new static($url, 'POST', $action);
    }


    public function getUrl(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction(): callable
    {
        return $this->action;
    }

}