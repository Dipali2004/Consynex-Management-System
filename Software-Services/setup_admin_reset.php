<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

try {
    $pdo = Database::conn();
    
    // Add email column if it doesn't exist
    $stmt = $pdo->query("SHOW COLUMNS FROM admin_users LIKE 'email'");
    if (!$stmt->fetch()) {
        $pdo->exec("ALTER TABLE admin_users ADD COLUMN email VARCHAR(255) DEFAULT NULL AFTER username");
        echo "Added 'email' column to admin_users table.<br>";
    }

    // Add reset_token column if it doesn't exist
    $stmt = $pdo->query("SHOW COLUMNS FROM admin_users LIKE 'reset_token'");
    if (!$stmt->fetch()) {
        $pdo->exec("ALTER TABLE admin_users ADD COLUMN reset_token VARCHAR(255) DEFAULT NULL AFTER active");
        echo "Added 'reset_token' column to admin_users table.<br>";
    }

    // Add reset_expiry column if it doesn't exist
    $stmt = $pdo->query("SHOW COLUMNS FROM admin_users LIKE 'reset_expiry'");
    if (!$stmt->fetch()) {
        $pdo->exec("ALTER TABLE admin_users ADD COLUMN reset_expiry DATETIME DEFAULT NULL AFTER reset_token");
        echo "Added 'reset_expiry' column to admin_users table.<br>";
    }

    // Set a default email for the admin user if it's null
    $pdo->exec("UPDATE admin_users SET email = 'admin@example.com' WHERE username = 'admin' AND email IS NULL");
    echo "Set default email for admin user.<br>";

    echo "Admin users table update complete.";
} catch (Exception $e) {
    echo "Error updating admin_users table: " . $e->getMessage();
}
