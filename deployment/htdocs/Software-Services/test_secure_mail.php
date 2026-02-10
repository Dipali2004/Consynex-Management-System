<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Autoload
require_once __DIR__ . '/../training/app/SimpleSMTP.php';
require_once __DIR__ . '/../training/app/EnvLoader.php';
require_once __DIR__ . '/../training/app/Mailer.php';

use TrainingApp\App\Mailer;
use TrainingApp\App\EnvLoader;

echo "<h1>Secure Mailer Test</h1>";

// Check .env status directly
$envPath = __DIR__ . '/../.env';
echo "<p>Checking .env file at: <code>" . htmlspecialchars(realpath($envPath) ?: $envPath) . "</code></p>";

if (file_exists($envPath)) {
    echo "<p style='color:green'>.env file found.</p>";
    EnvLoader::load($envPath);
    
    $user = $_ENV['SMTP_USER'] ?? '';
    $pass = $_ENV['SMTP_PASS'] ?? '';
    
    echo "<ul>";
    echo "<li>SMTP_USER: " . htmlspecialchars($user) . "</li>";
    echo "<li>SMTP_PASS: " . (empty($pass) ? "<b style='color:red'>MISSING (Empty)</b>" : "<b style='color:green'>Present (Hidden)</b>") . "</li>";
    echo "</ul>";
    
    if (empty($pass)) {
        echo "<div style='background:#fff3cd; padding:15px; border:1px solid #ffeeba;'>";
        echo "<h3>Action Required:</h3>";
        echo "<p>You have not entered your Gmail App Password in the .env file yet.</p>";
        echo "<ol>";
        echo "<li>Open the file: <code>c:\\xampp\\htdocs\\Collage website\\.env</code></li>";
        echo "<li>Find the line <code>SMTP_PASS=</code></li>";
        echo "<li>Paste your 16-character App Password after the equals sign.</li>";
        echo "<li>Save the file and refresh this page.</li>";
        echo "</ol>";
        exit;
    }
} else {
    echo "<p style='color:red'>Error: .env file NOT found.</p>";
    exit;
}

try {
    $mailer = new Mailer();
    
    // Test Data
    $data = [
        'inquiry_type' => 'Test',
        'reference_name' => 'Secure Mailer Verification',
        'name' => 'Security Test User',
        'mobile' => '1234567890',
        'email' => 'test@secure.local',
        'message' => 'This is a test to verify environment variable loading.'
    ];

    echo "<p>Attempting to send email...</p>";
    
    if ($mailer->sendInquiry($data)) {
        echo "<h2 style='color:green'>SUCCESS! Email Sent.</h2>";
    } else {
        echo "<h2 style='color:red'>FAILED to Send.</h2>";
        echo "<h3>Debug Logs:</h3>";
        echo "<pre>" . htmlspecialchars($mailer->getLogs()) . "</pre>";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>