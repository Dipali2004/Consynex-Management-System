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
            try {
                self::$pdo = new PDO($cfg['dsn'], $cfg['user'], $cfg['pass'], $cfg['options']);
            } catch (\PDOException $e) {
                // If the connection is refused, it usually means MySQL is not running
                if ($e->getCode() === 2002 || strpos($e->getMessage(), 'refused') !== false) {
                    die("<h1>Database Connection Error</h1><p>Could not connect to the database. <strong>Please ensure the MySQL server is running in XAMPP.</strong></p><p>Error details: " . htmlspecialchars($e->getMessage()) . "</p>");
                }
                throw $e;
            }
        }
        return self::$pdo;
    }
}

