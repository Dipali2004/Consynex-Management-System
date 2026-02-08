<?php
require_once __DIR__ . '/training/app/Config.php';
require_once __DIR__ . '/training/app/Database.php';
use TrainingApp\App\Database;

try {
    $pdo = Database::conn();
    $stmt = $pdo->query("DESCRIBE courses");
    echo "Table 'courses' columns:\n";
    print_r($stmt->fetchAll(PDO::FETCH_COLUMN));
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
