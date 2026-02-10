<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

try {
    $pdo = Database::conn();
    $stmt = $pdo->query("DESCRIBE courses");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($columns);
} catch (Exception $e) {
    echo "Table 'courses' might not exist or error: " . $e->getMessage();
}
