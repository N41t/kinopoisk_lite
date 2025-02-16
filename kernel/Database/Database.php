<?php

namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;

class Database implements DatabaseInterface
{

    private \PDO $pdo;


    public function __construct(
        private ConfigInterface $config
    )
    {
        $this->connect();
    }

    // добавление сущности в БД (int - id записи)
    public function insert(string $table, array $data): int|false
    {
        // получение полей в которые будем заносить данные. Array_keys - возвращает все ключи переданного массива
        $fields = array_keys($data);

        // формирование строки для sql-запроса (insert into movies (name, field2) values (:name, :field2))
        // implode - позволяет переводить массив в строки с использованием разделителя
        // array_map - применяет заданную функцию к каждому элементу массива (необходим чтобы каждому из элементов подставить двоеточие)
        // такое формирование sql-запроса позволяет избежать sql-инъекций
        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($field) => ":$field", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

//        dd ($sql);

        // подготовка sql-запроса
        $statement = $this->pdo->prepare($sql);

        // выполнение sql-запроса
        try {
            $statement->execute($data);
        } catch (\PDOException $exception) {
            // если sql-запрос не будет выполнен
            return false;
        }

        // если sql-запрос выполнен, вернет id добавленной записи
        return (int) $this->pdo->lastInsertId();

    }

    // подключение к БД
    private function connect()
    {

        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');


        // для понятного отображения ошибки
        try {
            // соединение между PHP и сервером базы данных
            $this->pdo = new \PDO(
                "$driver:host=$host;port=$port;dbname=$database;charset=$charset",
                $username,
                $password
            );
        } catch (\PDOException $exception) {
            exit("Database connection failed: {$exception->getMessage()}");
        }
    }
}