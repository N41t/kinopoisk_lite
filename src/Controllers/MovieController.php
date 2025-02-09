<?php

namespace App\Controllers;

use App\Kernel\View\View;

class MovieController
{
    public function index() {
        $view = new View();

        $view->page('movies');
    }
}