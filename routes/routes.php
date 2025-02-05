<?php

return [
    '/home' => function () {
//    /../ - перейти на директорию назад
        include_once __DIR__ . '/../views/pages/home.php';
    },
    '/movies' => function () {
        include_once __DIR__ . '/../views/pages/movies.php';
    }
];