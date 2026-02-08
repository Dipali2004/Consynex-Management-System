<?php
// Standalone SMTP Tester for Hostinger Configuration
// Run this via browser: http://localhost:8000/Software-Services/test_smtp_refactored.php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/training/app/Mailer.php';

use TrainingApp\App\Mailer;

echo "<h1>SMTP Diagnostic Tool (Refactored)</h1>";
echo "<pre>";

try {
    $mailer = new Mailer();
    
    // We can't access private methods directly, but we can verify sendEmailGeneric works
    echo "<b>Attempting to send test email...</b>\n";
    echo "Using generic method: sendEmailGeneric()\n";
    
    // Send to admin email (simulating an inquiry)
    $to = 'dipalishinde560@gmail.com'; 
    $subject = 'SMTP Refactor Test - ' . date('Y-m-d H:i:s');
    $message = "This is a test email sent using the refactored Mailer class.\n\n" .
               "It uses the central get_smtp_config() and sendEmailGeneric() logic.";
    
    $result = $mailer->sendEmailGeneric($to, $subject, $message);
    
    if ($result) {
        echo "\n<span style='color:green; font-weight:bold; font-size:1.2em'>✅ SUCCESS: Email sent successfully!</span>\n";
        echo "Check inbox for: $to\n";
    } else {
        echo "\n<span style='color:red; font-weight:bold; font-size:1.2em'>❌ FAILED: Email sending failed.</span>\n";
        echo "Logs:\n";
        echo $mailer->getLogs();
    }

} catch (Exception $e) {
    echo "\n<span style='color:red; font-weight:bold; font-size:1.2em'>❌ FAILED: " . $e->getMessage() . "</span>\n";
}

echo "</pre>";
