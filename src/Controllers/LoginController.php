<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{

    // отображение формы
    public function index(): void
    {
        $this->view('login');
    }
}