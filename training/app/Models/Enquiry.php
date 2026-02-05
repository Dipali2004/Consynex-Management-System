<?php
declare(strict_types=1);

namespace TrainingApp\App\Models;

use TrainingApp\App\Database;
use PDO;

class Enquiry
{
    public static function create(array $d): int
    {
        $stmt = Database::conn()->prepare('INSERT INTO enquiries (name, email, phone, message, source, status, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())');
        $stmt->execute([$d['name'], $d['email'], $d['phone'], $d['message'], $d['source'], 'new']);
        return (int)Database::conn()->lastInsertId();
    }

    public static function all(): array
    {
        $stmt = Database::conn()->query('SELECT id, name, email, phone, message, source, status, created_at FROM enquiries ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public static function updateStatus(int $id, string $status): bool
    {
        $stmt = Database::conn()->prepare('UPDATE enquiries SET status=? WHERE id=?');
        return $stmt->execute([$status, $id]);
    }
}

