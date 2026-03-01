<?php
declare(strict_types=1);

namespace TrainingApp\App;

class Config
{
    public static function db(): array
    {
        return [
            'dsn' => getenv('DB_DSN') ?: 'mysql:host=127.0.0.1;port=3306;dbname=training_app;charset=utf8mb4',
            'user' => getenv('DB_USER') ?: 'root',
            'pass' => getenv('DB_PASS') !== false ? getenv('DB_PASS') : '',
            'options' => [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ],
        ];
    }
}

