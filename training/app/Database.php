<?php
declare(strict_types=1);

namespace TrainingApp\App;

use PDO;

class Database
{
    private static ?PDO $pdo = null;

    public static function conn(): PDO
    {
        if (self::$pdo === null) {
            $cfg = Config::db();
            self::$pdo = new PDO($cfg['dsn'], $cfg['user'], $cfg['pass'], $cfg['options']);
        }
        return self::$pdo;
    }
}

