<?php

namespace App\Kernel\View;

use App\Kernel\Exceptions\ViewNotFoundException;

class View
{

    // отображает страницу переданную в параметрах
    public function page(string $name): void
    {

        $viewPath = APP_PATH . "/views/pages/$name.php";

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException('View $name not found');
        }

        // внедрение переменных в шаблоны. То что указано как ключ - является названием переменной для использ. в шаблоне
        extract([
            'view' => $this
        ]);

        include_once $viewPath;
    }

    public function component(string $name): void
    {

        $componentPath = APP_PATH . "/views/components/$name.php";

        if (!file_exists($componentPath)) {
            echo "Component $name not found";
            return;
        }

        include_once $componentPath;
    }
}