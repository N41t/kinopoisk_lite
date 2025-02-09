<?php

namespace App\Kernel\View;

class View
{

    // отображает страницу переданную в параметрах
    public function page(string $name): void
    {

        $viewPath = APP_PATH . "/views/pages/$name.php";

        if (!file_exists($viewPath)) {
            throw new \Exception('View $name not found');
        }

        // внедрение переменных в шаблоны. То что указано как ключ - является названием переменной для использ. в шаблоне
        extract([
            'view' => $this
        ]);

        include_once APP_PATH . "/views/pages/$name.php";
    }

    public function component(string $name): void
    {
        include_once APP_PATH . "/views/components/$name.php";
    }
}