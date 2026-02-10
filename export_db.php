<?php
// DB Credentials
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$name = 'training_app';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    $sql = "-- Database Export for training_app\n-- Generated on " . date('Y-m-d H:i:s') . "\n\n";

    foreach ($tables as $table) {
        // Create Table SQL
        $stmt = $pdo->query("SHOW CREATE TABLE `$table`");
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $sql .= "\n\n" . $row[1] . ";\n\n";

        // Insert Data SQL
        $rows = $pdo->query("SELECT * FROM `$table`");
        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
            $values = array_map(function ($value) use ($pdo) {
                if ($value === null) return "NULL";
                return $pdo->quote($value);
            }, array_values($row));
            $sql .= "INSERT INTO `$table` VALUES (" . implode(", ", $values) . ");\n";
        }
    }

    if (!is_dir(__DIR__ . '/deployment')) {
        mkdir(__DIR__ . '/deployment', 0777, true);
    }
    
    file_put_contents(__DIR__ . '/deployment/database.sql', $sql);
    echo "Database dump created at deployment/database.sql";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
