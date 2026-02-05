<?php
declare(strict_types=1);

namespace TrainingApp\App\Models;

use TrainingApp\App\Database;

class AdminUser
{
    public static function findByUsername(string $u): ?array
    {
        $stmt = Database::conn()->prepare('SELECT id, username, password_hash, active FROM admin_users WHERE username=? LIMIT 1');
        $stmt->execute([$u]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}

