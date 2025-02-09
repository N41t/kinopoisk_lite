<?php

namespace App\Controllers;

use App\Kernel\View\View;

class HomeController
{
    public function index() {
        $view = new View();

        $view->page('home');
    }
}