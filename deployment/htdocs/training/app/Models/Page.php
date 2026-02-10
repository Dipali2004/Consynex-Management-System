<?php
declare(strict_types=1);

namespace TrainingApp\App\Models;

use TrainingApp\App\Database;

class Page
{
    public static function get(string $key): ?array
    {
        $stmt = Database::conn()->prepare('SELECT key_name, title, content, data_json FROM pages WHERE key_name=? LIMIT 1');
        $stmt->execute([$key]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function upsert(string $key, array $d): bool
    {
        $stmt = Database::conn()->prepare('INSERT INTO pages (key_name, title, content, data_json) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE title=VALUES(title), content=VALUES(content), data_json=VALUES(data_json)');
        return $stmt->execute([$key, $d['title'], $d['content'], $d['data_json']]);
    }
}

