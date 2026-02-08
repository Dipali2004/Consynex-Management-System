<?php
declare(strict_types=1);

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "<h1>Email Configuration Test</h1>";

// 1. Check Config File
$config_path = __DIR__ . '/includes/mail_config.php';
if (!file_exists($config_path)) {
    die("<p style='color:red'>Error: Config file missing at $config_path</p>");
}

$config = require $config_path;
echo "<p>Config loaded.</p>";
echo "<ul>";
echo "<li>User: " . htmlspecialchars($config['smtp_user']) . "</li>";
echo "<li>Host: " . htmlspecialchars($config['smtp_host']) . "</li>";
echo "<li>Port: " . htmlspecialchars((string)$config['smtp_port']) . "</li>";
echo "<li>Password Status: " . (empty($config['smtp_pass']) ? "<b style='color:red'>MISSING (Empty)</b>" : "<b style='color:green'>Present (Hidden)</b>") . "</li>";
echo "</ul>";

if (empty($config['smtp_pass'])) {
    echo "<div style='background:#fff3cd; padding:15px; border:1px solid #ffeeba;'>";
    echo "<h3>Action Required:</h3>";
    echo "<p>You have not entered your Gmail App Password yet.</p>";
    echo "<ol>";
    echo "<li>Go to <a href='https://myaccount.google.com/apppasswords' target='_blank'>Google App Passwords</a></li>";
    echo "<li>Generate a new password (name it 'Localhost')</li>";
    echo "<li>Open the file: <code>c:\\xampp\\htdocs\\Collage website\\Software-Services\\includes\\mail_config.php</code></li>";
    echo "<li>Paste the 16-character code into the <code>'smtp_pass'</code> field.</li>";
    echo "</ol>";
    echo "</div>";
    exit;
}

// 2. Load SMTP Class
require_once __DIR__ . '/../training/app/SimpleSMTP.php';
use TrainingApp\App\SimpleSMTP;

echo "<p>Attempting to connect to Gmail...</p>";
flush();

try {
    $smtp = new SimpleSMTP($config['smtp_host'], (int)$config['smtp_port'], $config['smtp_user'], $config['smtp_pass']);
    
    $to = $config['smtp_user']; // Send to self
    $subject = "Test Email from Localhost " . date('H:i:s');
    $body = "If you are reading this, your email configuration is working perfectly!";
    
    if ($smtp->send($to, $subject, $body)) {
        echo "<h2 style='color:green'>SUCCESS! Email Sent.</h2>";
        echo "<p>Check your inbox (" . htmlspecialchars($to) . ") for the test email.</p>";
    } else {
        echo "<h2 style='color:red'>FAILED to Send.</h2>";
        echo "<h3>Debug Log:</h3>";
        echo "<pre style='background:#f8f9fa; padding:10px; border:1px solid #ddd;'>" . htmlspecialchars($smtp->getLog()) . "</pre>";
    }

} catch (Exception $e) {
    echo "<h2 style='color:red'>Error Occurred</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
?>