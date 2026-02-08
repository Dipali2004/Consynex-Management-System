<?php
require_once __DIR__ . '/admin/bootstrap.php';

use TrainingApp\App\Database;

try {
    $pdo = Database::conn();
    
    // Create service_requests table
    $sql = "CREATE TABLE IF NOT EXISTS service_requests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        service_id INT DEFAULT NULL,
        service_name VARCHAR(100) NOT NULL,
        customer_name VARCHAR(100) NOT NULL,
        mobile VARCHAR(20) NOT NULL,
        email VARCHAR(100),
        address TEXT,
        preferred_date DATE,
        preferred_time VARCHAR(50),
        message TEXT,
        status ENUM('Pending', 'Assigned', 'Completed', 'Cancelled') DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table 'service_requests' created or already exists.\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
