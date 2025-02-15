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
        // TODO: Implement insert() method.
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

        // соединение между PHP и сервером базы данных
        $this->pdo = new \PDO(
            "$driver:host=$host;port=$port;dbname=$database;charset=$charset",
            $username,
            $password
        );
    }
}