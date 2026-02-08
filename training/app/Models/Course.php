<?php
declare(strict_types=1);

namespace TrainingApp\App\Models;

use TrainingApp\App\Database;
use PDO;

class Course
{
    public static function allActive(): array
    {
        // Select 'image' as 'image_path' to support Admin uploaded images
        $stmt = Database::conn()->prepare('SELECT id, name, slug, duration, level, COALESCE(image, image_path) as image_path, fees, description, featured FROM courses WHERE status=1 ORDER BY id DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function featured(int $limit = 6): array
    {
        $stmt = Database::conn()->prepare('SELECT id, name, slug, duration, level, COALESCE(image, image_path) as image_path, fees, description FROM courses WHERE status=1 AND featured=1 ORDER BY id DESC LIMIT ?');
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function findBySlug(string $slug): ?array
    {
        $stmt = Database::conn()->prepare('SELECT id, name, slug, duration, level, COALESCE(image, image_path) as image_path, fees, description FROM courses WHERE slug=? AND status=1');
        $stmt->execute([$slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $d): int
    {
        $stmt = Database::conn()->prepare('INSERT INTO courses (name, slug, duration, level, image_path, fees, description, status, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$d['name'], $d['slug'], $d['duration'], $d['level'], $d['image_path'], $d['fees'], $d['description'], (int)$d['status'], (int)$d['featured']]);
        return (int)Database::conn()->lastInsertId();
    }

    public static function update(int $id, array $d): bool
    {
        $stmt = Database::conn()->prepare('UPDATE courses SET name=?, slug=?, duration=?, level=?, image_path=?, fees=?, description=?, status=?, featured=? WHERE id=?');
        return $stmt->execute([$d['name'], $d['slug'], $d['duration'], $d['level'], $d['image_path'], $d['fees'], $d['description'], (int)$d['status'], (int)$d['featured'], $id]);
    }

    public static function delete(int $id): bool
    {
        $stmt = Database::conn()->prepare('DELETE FROM courses WHERE id=?');
        return $stmt->execute([$id]);
    }
}
