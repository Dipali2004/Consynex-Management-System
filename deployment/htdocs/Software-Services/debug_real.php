<?php
// Software-Services/debug_real.php

// 1. Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>System Diagnostic Tool</h1>";
echo "<pre>";

// 2. Define Autoloader (same as ajax_submit_inquiry.php)
spl_autoload_register(function ($class) {
    $prefix = 'TrainingApp\\App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $rel = substr($class, strlen($prefix));
    $path = __DIR__ . '/../training/app/' . str_replace('\\', '/', $rel) . '.php';
    echo "Loading class $class from $path... ";
    if (is_file($path)) {
        require $path;
        echo "[OK]\n";
    } else {
        echo "[FAILED - File not found]\n";
    }
});

use TrainingApp\App\Database;
use TrainingApp\App\Config;
use TrainingApp\App\Models\Enquiry;

// 3. Check Database Connection
try {
    echo "\n--- Checking Database Connection ---\n";
    $cfg = Config::db();
    echo "DSN: " . $cfg['dsn'] . "\n";
    
    $pdo = Database::conn();
    echo "Connection Successful!\n";
    
    // 4. Check Table Existence
    echo "\n--- Checking 'inquiries' Table ---\n";
    $stmt = $pdo->query("SHOW TABLES LIKE 'inquiries'");
    $tableExists = $stmt->fetch();
    
    if ($tableExists) {
        echo "Table 'inquiries' EXISTS.\n";
        
        // Show columns
        $stmt = $pdo->query("DESCRIBE inquiries");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo "Columns: " . implode(", ", $columns) . "\n";
        
    } else {
        echo "CRITICAL ERROR: Table 'inquiries' DOES NOT EXIST in database 'training_app'.\n";
        // Attempt to create it if missing
        $sql = "CREATE TABLE inquiries (
            id INT AUTO_INCREMENT PRIMARY KEY,
            inquiry_type ENUM('Course', 'Service') NOT NULL,
            reference_name VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            mobile VARCHAR(20) NOT NULL,
            email VARCHAR(255),
            message TEXT,
            status ENUM('Pending', 'Read', 'Closed') DEFAULT 'Pending',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $pdo->exec($sql);
        echo "Attempted to create table 'inquiries'... Check if it exists now.\n";
    }
    
    // 5. Test Insertion via Model
    echo "\n--- Testing Model Insertion ---\n";
    $testData = [
        'inquiry_type' => 'Service',
        'reference_name' => 'Debug Test Service',
        'name' => 'Debug User',
        'mobile' => '9999999999',
        'email' => 'debug@test.com',
        'message' => 'This is a debug test message.'
    ];
    
    $newId = Enquiry::create($testData);
    echo "Insertion returned ID: " . $newId . "\n";
    
    if ($newId > 0) {
        echo "SUCCESS: Record inserted successfully.\n";
        
        // 6. Test Retrieval
        echo "\n--- Testing Retrieval ---\n";
        $rec = Enquiry::getByType('Service');
        echo "Found " . count($rec) . " Service inquiries.\n";
        echo "Latest record: " . print_r($rec[0] ?? 'None', true) . "\n";
    } else {
        echo "FAILURE: Insertion returned 0.\n";
    }

} catch (Exception $e) {
    echo "EXCEPTION CAUGHT:\n";
    echo $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}

echo "</pre>";
?>