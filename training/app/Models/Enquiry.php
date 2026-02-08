<?php
declare(strict_types=1);

namespace TrainingApp\App\Models;

use TrainingApp\App\Database;
use PDO;

class Enquiry
{
    public static function create(array $d): int
    {
        $stmt = Database::conn()->prepare('INSERT INTO inquiries (inquiry_type, reference_name, name, mobile, email, message, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())');
        $stmt->execute([
            $d['inquiry_type'],
            $d['reference_name'],
            $d['name'],
            $d['mobile'],
            $d['email'],
            $d['message'],
            'Pending'
        ]);
        return (int)Database::conn()->lastInsertId();
    }

    public static function all(): array
    {
        $stmt = Database::conn()->query('SELECT * FROM inquiries ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public static function updateStatus(int $id, string $status): bool
    {
        $stmt = Database::conn()->prepare('UPDATE inquiries SET status=? WHERE id=?');
        return $stmt->execute([$status, $id]);
    }

    public static function getByType(string $type): array
    {
        $stmt = Database::conn()->prepare('SELECT * FROM inquiries WHERE inquiry_type = ? ORDER BY created_at DESC');
        $stmt->execute([$type]);
        return $stmt->fetchAll();
    }

    public static function filter(array $filters = []): array
    {
        $sql = 'SELECT * FROM inquiries WHERE 1=1';
        $params = [];

        if (!empty($filters['type'])) {
            $sql .= ' AND inquiry_type = ?';
            $params[] = $filters['type'];
        }

        if (!empty($filters['date'])) {
            $sql .= ' AND DATE(created_at) = ?';
            $params[] = $filters['date'];
        }
        
        if (!empty($filters['status'])) {
            $sql .= ' AND status = ?';
            $params[] = $filters['status'];
        }

        $sql .= ' ORDER BY created_at DESC';

        $stmt = Database::conn()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
