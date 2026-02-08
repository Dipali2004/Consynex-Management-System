<?php
require_once __DIR__ . '/training/app/Config.php';
require_once __DIR__ . '/training/app/Database.php';
use TrainingApp\App\Database;

try {
    $pdo = Database::conn();
    $stmt = $pdo->query("DESCRIBE banners");
    echo "Table 'banners' exists. Columns:\n";
    print_r($stmt->fetchAll(PDO::FETCH_COLUMN));
} catch (Exception $e) {
    echo "Table 'banners' does not exist or error: " . $e->getMessage();
}
