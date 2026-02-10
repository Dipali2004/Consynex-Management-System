<?php
declare(strict_types=1);

namespace TrainingApp\App\Models;

use TrainingApp\App\Database;
use PDO;

class Banner
{
    public static function allActive(): array
    {
        $stmt = Database::conn()->prepare('SELECT id, title, image_path, link_url FROM banners WHERE status=1 ORDER BY sort_order ASC, id DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function create(array $d): int
    {
        $stmt = Database::conn()->prepare('INSERT INTO banners (title, image_path, link_url, status, sort_order) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$d['title'], $d['image_path'], $d['link_url'], (int)$d['status'], (int)$d['sort_order']]);
        return (int)Database::conn()->lastInsertId();
    }

    public static function update(int $id, array $d): bool
    {
        $stmt = Database::conn()->prepare('UPDATE banners SET title=?, image_path=?, link_url=?, status=?, sort_order=? WHERE id=?');
        return $stmt->execute([$d['title'], $d['image_path'], $d['link_url'], (int)$d['status'], (int)$d['sort_order'], $id]);
    }

    public static function delete(int $id): bool
    {
        $stmt = Database::conn()->prepare('DELETE FROM banners WHERE id=?');
        return $stmt->execute([$id]);
    }
}

