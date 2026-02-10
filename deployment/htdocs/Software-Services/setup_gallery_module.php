<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

try {
    $pdo = Database::conn();
    
    // Create gallery table
    $sql = "CREATE TABLE IF NOT EXISTS gallery (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NULL,
        category VARCHAR(100) NOT NULL,
        image_path VARCHAR(255) NOT NULL,
        status TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table 'gallery' created or already exists.\n";

    // Create uploads directory if not exists
    $uploadDir = __DIR__ . '/uploads/gallery';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
        echo "Created directory: $uploadDir\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
