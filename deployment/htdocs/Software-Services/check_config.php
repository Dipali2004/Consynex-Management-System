<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Include bootstrap early to avoid headers sent warning
require_once __DIR__ . '/admin/bootstrap.php';

echo "<h1>System Configuration Check</h1>";

// 1. Check .env file
$envPath = __DIR__ . '/../.env';
echo "<h2>1. Environment Configuration</h2>";
if (file_exists($envPath)) {
    echo "<p style='color:green'>✅ .env file found.</p>";
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $apiKeyFound = false;
    foreach ($lines as $line) {
        if (strpos(trim($line), 'SENDGRID_API_KEY') === 0) {
            $parts = explode('=', $line, 2);
            $key = trim($parts[1] ?? '');
            $apiKeyFound = true; // Mark as found regardless of value
            if (!empty($key)) {
                echo "<p style='color:green'>✅ SENDGRID_API_KEY is configured (Length: " . strlen($key) . ").</p>";
            } else {
                echo "<p style='color:red'>❌ SENDGRID_API_KEY is present but EMPTY.</p>";
            }
        }
    }
    if (!$apiKeyFound) {
        echo "<p style='color:red'>❌ SENDGRID_API_KEY variable not found in .env.</p>";
    }
} else {
    echo "<p style='color:red'>❌ .env file NOT found at $envPath.</p>";
}

// 2. Check Database
echo "<h2>2. Database Connection</h2>";
require_once __DIR__ . '/admin/bootstrap.php';
try {
    $pdo = \TrainingApp\App\Database::conn();
    echo "<p style='color:green'>✅ Database Connected Successfully.</p>";
    
    // Check table
    $stmt = $pdo->query("SHOW TABLES LIKE 'inquiries'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color:green'>✅ 'inquiries' table exists.</p>";
        
        $count = $pdo->query("SELECT COUNT(*) FROM inquiries")->fetchColumn();
        echo "<p>Total Inquiries in DB: <strong>$count</strong></p>";
        
        // Show last 5
        echo "<h3>Recent Inquiries (Last 5):</h3>";
        $rows = $pdo->query("SELECT id, inquiry_type, name, email, created_at FROM inquiries ORDER BY id DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
        if ($rows) {
            echo "<table border='1' cellpadding='5' style='border-collapse:collapse'>";
            echo "<tr><th>ID</th><th>Type</th><th>Name</th><th>Email</th><th>Date</th></tr>";
            foreach ($rows as $r) {
                echo "<tr>";
                echo "<td>{$r['id']}</td>";
                echo "<td>{$r['inquiry_type']}</td>";
                echo "<td>{$r['name']}</td>";
                echo "<td>{$r['email']}</td>";
                echo "<td>{$r['created_at']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
    } else {
        echo "<p style='color:red'>❌ 'inquiries' table MISSING.</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color:red'>❌ Database Connection Failed: " . $e->getMessage() . "</p>";
}

// 3. Check PHP Extensions
echo "<h2>3. PHP Extensions</h2>";
echo "<p>cURL: " . (extension_loaded('curl') ? "<span style='color:green'>✅ Enabled</span>" : "<span style='color:red'>❌ Disabled</span>") . "</p>";
echo "<p>OpenSSL: " . (extension_loaded('openssl') ? "<span style='color:green'>✅ Enabled</span>" : "<span style='color:red'>❌ Disabled</span>") . "</p>";

echo "<h2>4. Logs</h2>";
$logFile = __DIR__ . '/debug_log.txt';
if (file_exists($logFile)) {
    echo "<p>Recent Logs:</p>";
    echo "<pre style='background:#f5f5f5; padding:10px; max-height:300px; overflow:auto;'>" . htmlspecialchars(file_get_contents($logFile)) . "</pre>";
} else {
    echo "<p>No debug log found.</p>";
}

?>