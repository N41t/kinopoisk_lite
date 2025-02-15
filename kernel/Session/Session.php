<?php

namespace App\Kernel\Session;

class Session implements SessionInterface
{
    public function __construct(){
        session_start();
    }


    // передает значение сессии
    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }


    // получает значение сессии
    public function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }


    // получает значение и сразу удаляет его из сессии
    public function getFlash(string $key, $default = null)
    {
        $value = $this->get($key, $default);
        $this->remove($key);

        return $value;
    }

    // проверяет наличие элемента в сессии
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }


    // удаляет элемент из сессии
    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }


    // уничтожает сессию
    public function destroy(): void
    {
        session_destroy();
    }
}