<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    // получение формы регистрации
    public function index()
    {
        $this->view('register');
    }


    // отправка данных в форме регистрации
    public function register()
    {
        $validation = $this->getRequest()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);

        // если валидация не прошла
        if (!$validation) {
            // перебираем все полученные после валидации ошибки и название самого поля и заносим их в сессию
            foreach ($this->getRequest()->getErrors() as $field => $errors) {
                $this->getSession()->set($field, $errors);
            }

            $this->redirect('/register');
        }

        $userId = $this->getDatabase()->insert('users', [
            'email' => $this->getRequest()->input('email'),
            'password' => password_hash($this->getRequest()->input('password'), PASSWORD_DEFAULT)
        ]);

        // иначе добавляем пользователя в БД
        dd('User created with id: ' . $userId);
    }
}