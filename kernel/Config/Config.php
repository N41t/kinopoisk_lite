<?php

namespace App\Kernel\Config;


// класс для возможности получения конфигурационных файлов из config
class Config implements ConfigInterface
{

    public function get(string $key, $default = null): mixed
    {
        // формат получения данных из файла config используя данный метод: database.host

        // получение файла config
        [$file, $key] = explode('.', $key);

        // путь до файла config
        $configPath = APP_PATH."/config/$file.php";

        // проверка на существование config файла
        if (! file_exists($configPath)) {
            return $default;
        }

        // получение config
        $config = require $configPath;

        // возвращаем значение под ключом
        return $config[$key] ?? $default;
    }
}