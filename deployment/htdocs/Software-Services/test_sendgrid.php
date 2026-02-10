<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Autoload
require_once __DIR__ . '/../training/app/EnvLoader.php';
require_once __DIR__ . '/../training/app/Mailer.php';

use TrainingApp\App\Mailer;
use TrainingApp\App\EnvLoader;

echo "<h1>SendGrid Mailer Test</h1>";

// Check .env status directly
$envPath = __DIR__ . '/../.env';
echo "<p>Checking .env file at: <code>" . htmlspecialchars(realpath($envPath) ?: $envPath) . "</code></p>";

if (file_exists($envPath)) {
    echo "<p style='color:green'>.env file found.</p>";
    EnvLoader::load($envPath);
    
    $key = $_ENV['SENDGRID_API_KEY'] ?? '';
    $from = $_ENV['FROM_EMAIL'] ?? '';
    
    echo "<ul>";
    echo "<li>API Key Status: " . (empty($key) ? "<b style='color:red'>MISSING (Empty)</b>" : "<b style='color:green'>Present (Hidden)</b>") . "</li>";
    echo "<li>From Email: " . htmlspecialchars($from) . "</li>";
    echo "</ul>";
    
    if (empty($key)) {
        echo "<div style='background:#fff3cd; padding:15px; border:1px solid #ffeeba;'>";
        echo "<h3>Action Required:</h3>";
        echo "<p>You have not entered your SendGrid API Key yet.</p>";
        echo "<ol>";
        echo "<li>Go to <a href='https://app.sendgrid.com/settings/api_keys' target='_blank'>SendGrid API Keys</a></li>";
        echo "<li>Create a new key with 'Mail Send' permissions.</li>";
        echo "<li>Open the file: <code>c:\\xampp\\htdocs\\Collage website\\.env</code></li>";
        echo "<li>Paste the key into <code>SENDGRID_API_KEY=SG....</code></li>";
        echo "</ol>";
        echo "</div>";
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
        'inquiry_type' => 'SendGrid Test',
        'reference_name' => 'API Verification',
        'name' => 'API Tester',
        'mobile' => '9999999999',
        'email' => 'test@sendgrid.local',
        'message' => 'This is a test email sent via SendGrid REST API.'
    ];

    echo "<p>Attempting to send email via SendGrid...</p>";
    
    if ($mailer->sendInquiry($data)) {
        echo "<h2 style='color:green'>SUCCESS! Email Sent via SendGrid.</h2>";
    } else {
        echo "<h2 style='color:red'>FAILED to Send.</h2>";
        echo "<h3>Debug Logs:</h3>";
        echo "<pre>" . htmlspecialchars($mailer->getLogs()) . "</pre>";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>