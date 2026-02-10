<?php
/**
 * DEBUG SCRIPT FOR STAGING
 * Upload this file to /Software-Services/admin/debug_staging.php
 * Run it by visiting: http://your-domain/Software-Services/admin/debug_staging.php
 */

ini_set('display_errors', '1');
error_reporting(E_ALL);
session_start();

echo "<h1>Staging Debug Tool</h1>";

// 1. Check Session Path
echo "<h2>1. Session Check</h2>";
echo "Session Save Path: " . session_save_path() . "<br>";
echo "Session ID: " . session_id() . "<br>";
$_SESSION['test_var'] = 'InfinityFree';
echo "Set Session Variable: " . $_SESSION['test_var'] . "<br>";

// 2. Check Database Connection
echo "<h2>2. Database Check</h2>";
$configPath = __DIR__ . '/../../training/app/Config.php';

if (!file_exists($configPath)) {
    echo "<strong style='color:red'>ERROR: Config file not found at $configPath</strong><br>";
} else {
    echo "Config file found.<br>";
    require_once $configPath;
    
    try {
        $cfg = \TrainingApp\App\Config::db();
        echo "Attempting connection to: " . $cfg['dsn'] . " (User: " . $cfg['user'] . ")<br>";
        
        $options = $cfg['options'] ?? [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        $pdo = new PDO($cfg['dsn'], $cfg['user'], $cfg['pass'], $options);
        echo "<strong style='color:green'>SUCCESS: Database Connected!</strong><br>";
        
        $stmt = $pdo->query("SELECT COUNT(*) FROM admin_users");
        echo "Admin Users Count: " . $stmt->fetchColumn() . "<br>";
        
    } catch (PDOException $e) {
        echo "<strong style='color:red'>DATABASE ERROR: " . $e->getMessage() . "</strong><br>";
    }
}

// 3. Check Directory Permissions
echo "<h2>3. Server Info</h2>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Current Script: " . __FILE__ . "<br>";

echo "<br><hr><a href='/Software-Services/admin/login.php'>Try Login Again</a>";
