<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=training_app;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Add columns if they don't exist
    $columns = $pdo->query("SHOW COLUMNS FROM admin_users")->fetchAll(PDO::FETCH_COLUMN);
    
    if (!in_array('failed_login_attempts', $columns)) {
        $pdo->exec("ALTER TABLE admin_users ADD COLUMN failed_login_attempts INT DEFAULT 0");
        echo "Added failed_login_attempts column.\n";
    }
    
    if (!in_array('account_locked_until', $columns)) {
        $pdo->exec("ALTER TABLE admin_users ADD COLUMN account_locked_until DATETIME NULL");
        echo "Added account_locked_until column.\n";
    }

    if (!in_array('last_failed_login', $columns)) {
        $pdo->exec("ALTER TABLE admin_users ADD COLUMN last_failed_login DATETIME NULL");
        echo "Added last_failed_login column.\n";
    }

    echo "Database schema updated successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
