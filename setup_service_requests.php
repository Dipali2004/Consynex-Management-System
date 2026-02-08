<?php
require_once __DIR__ . '/vendor/autoload.php';

// Manual Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'TrainingApp\\App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $rel = substr($class, strlen($prefix));
    $path = __DIR__ . '/training/app/' . str_replace('\\', '/', $rel) . '.php';
    if (is_file($path)) {
        require $path;
    }
});

use TrainingApp\App\Database;

try {
    $pdo = Database::conn();
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'service_requests'");
    if ($stmt->rowCount() == 0) {
        echo "Creating 'service_requests' table...\n";
        $sql = "CREATE TABLE service_requests (
            id INT AUTO_INCREMENT PRIMARY KEY,
            service_name VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            mobile VARCHAR(20) NOT NULL,
            email VARCHAR(255) NOT NULL,
            message TEXT,
            status VARCHAR(50) DEFAULT 'New',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $pdo->exec($sql);
        echo "Table 'service_requests' created successfully.\n";
    } else {
        echo "Table 'service_requests' already exists.\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
