<?php

namespace App\Kernel\Database;

class Database implements DatabaseInterface
{

    private \PDO $pdo;


    public function __construct()
    {
        $this->connect();
    }

    // добавление сущности в БД (int - id записи)
    public function insert(string $table, array $data): int|false
    {
        // TODO: Implement insert() method.
    }

    // подключение к БД
    private function connect()
    {
        // соединение между PHP и сервером базы данных
        $this->pdo = new \PDO(
            'mysql:host=localhost;port=3306;dbname=movie_db;charset=utf8',
            'root',
            'root');
    }
}