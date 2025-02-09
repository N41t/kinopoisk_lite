<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\View\View;

// делаем абстрактным, т.к. instance класса нам не нужен
abstract class Controller
{
    private View $view;

    private Request $request;




    // отправляем название страницы и отображать ее
    public function view(string $name): void
    {
        $this->view->page($name);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function getRequest(): Request {
        return $this->request;
    }

    public function setRequest(Request $request) {
        $this->request = $request;
    }

}