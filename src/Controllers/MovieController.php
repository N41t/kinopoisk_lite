<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
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

            // перебираем все полученные после валидации ошибки и название самого поля и заносим их в сессию
            foreach ($this->getRequest()->getErrors() as $field => $errors) {
                $this->getSession()->set($field, $errors);
            }

            $this->redirect('/admin/movies/add');

        } else {
            dd ('Validation passed');
        }
    }
}