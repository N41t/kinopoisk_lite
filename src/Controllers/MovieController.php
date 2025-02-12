<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Validator\Validator;
use App\Kernel\View\View;

class MovieController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
    }

    public function add(): void
    {
        $this->view('admin/movies/add');
    }

    public function store()
    {

        // описание правил валидации
        $validation = $this->getRequest()->validate([
            'name' => ['required', 'min:3', 'max:50'],
        ]);

        // если валидация имеет ошибки
        if (! $validation) {
            dd ('Validation failed', $this->getRequest()->errors());
        } else {
            dd ('Validation passed');
        }
    }
}