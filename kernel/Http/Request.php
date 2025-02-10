<?php

namespace App\Kernel\Http;

class Request
{

    // в конструкторе указываем данные, которые нам необходимо хранить при запросе
    // array - т.к. каждая из этих глобал. переменных это массив
    // readonly - позволяет сделать свойства публичными и не изменять их
    public function __construct(
        public readonly array $get,
        public readonly array $post,
        public readonly array $server,
        public readonly array $files,
        public readonly array $cookies
    )
    {}

    // фабричный метод для создания экземпляра request (instance себя же).
    public static function createFromGlobals(): static {
        return new static($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE,);
    }

    public function uri(): string {
        // получение пути из адреса
        // strtok - т.к. в параметрах запроса отсутствует get, strtok для разбиения строки по знаку ?
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function method(): string {
        // получение пути из адреса
        return $this->server['REQUEST_METHOD'];
    }


    // позволяет осуществлять дейтсвия с поля отправленного с формы и возвращать значения
    public function input(string $key, $default = null): mixed
    {
        // сначала попробует из post, потом из get, дальше default
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }


}