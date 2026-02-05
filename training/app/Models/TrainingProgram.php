<?php
declare(strict_types=1);

namespace TrainingApp\App\Models;

use TrainingApp\App\Database;
use PDO;

class TrainingProgram
{
    public static function allActive(): array
    {
        $stmt = Database::conn()->prepare('SELECT id, name, slug, description FROM training_programs WHERE status=1 ORDER BY id DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function findBySlug(string $slug): ?array
    {
        $stmt = Database::conn()->prepare('SELECT id, name, slug, description FROM training_programs WHERE slug=? AND status=1');
        $stmt->execute([$slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $d): int
    {
        $stmt = Database::conn()->prepare('INSERT INTO training_programs (name, slug, description, status) VALUES (?, ?, ?, ?)');
        $stmt->execute([$d['name'], $d['slug'], $d['description'], (int)$d['status']]);
        return (int)Database::conn()->lastInsertId();
    }

    public static function update(int $id, array $d): bool
    {
        $stmt = Database::conn()->prepare('UPDATE training_programs SET name=?, slug=?, description=?, status=? WHERE id=?');
        return $stmt->execute([$d['name'], $d['slug'], $d['description'], (int)$d['status'], $id]);
    }

    public static function delete(int $id): bool
    {
        $stmt = Database::conn()->prepare('DELETE FROM training_programs WHERE id=?');
        return $stmt->execute([$id]);
    }
}

