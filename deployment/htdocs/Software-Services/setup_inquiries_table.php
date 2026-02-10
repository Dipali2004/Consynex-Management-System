<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

try {
    $pdo = Database::conn();
    
    // Create the new unified inquiries table
    $sql = "CREATE TABLE IF NOT EXISTS inquiries (
        id INT AUTO_INCREMENT PRIMARY KEY,
        inquiry_type VARCHAR(50) NOT NULL, -- 'Course' or 'Service'
        reference_name VARCHAR(255) NULL, -- Course Name or Service Name
        name VARCHAR(100) NOT NULL,
        mobile VARCHAR(20) NOT NULL,
        email VARCHAR(100) NULL,
        message TEXT NULL,
        status VARCHAR(20) DEFAULT 'Pending', -- Pending, Read, Closed
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "Table 'inquiries' created successfully.<br>";
    
    // Check if columns need to be added (if table existed but with different schema)
    // For simplicity in this task, we assume the table creation is sufficient or we can alter it.
    // Given the previous setup was just 'course_inquiries', we are making a new table 'inquiries'.
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>