<?php
// Standalone SMTP Tester for Gmail
// Run this via browser: http://localhost:8000/Software-Services/test_smtp_real.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

// --- CONFIGURATION ---
// I will read these directly from Mailer.php to test EXACTLY what is configured there
require 'training/app/Mailer.php';

echo "<h1>Gmail SMTP Diagnostic Tool</h1>";
echo "<pre>";

try {
    // Reflection to get private properties from Mailer class (so we don't have to duplicate config)
    $mailerInstance = new \TrainingApp\App\Mailer();
    $reflector = new ReflectionClass($mailerInstance);
    
    $props = ['smtpHost', 'smtpUsername', 'smtpPassword', 'smtpPort', 'smtpSecure'];
    $config = [];
    
    foreach ($props as $propName) {
        $property = $reflector->getProperty($propName);
        $property->setAccessible(true);
        $config[$propName] = $property->getValue($mailerInstance);
    }
    
    echo "<b>Checking Configuration:</b>\n";
    echo "Host: " . $config['smtpHost'] . "\n";
    echo "Username: " . $config['smtpUsername'] . "\n";
    echo "Port: " . $config['smtpPort'] . "\n";
    
    // Check if password is still default
    // if ($config['smtpPassword'] === 'YOUR_APP_PASSWORD_HERE') {
    //    throw new Exception("❌ ERROR: You have not replaced 'YOUR_APP_PASSWORD_HERE' in Mailer.php with your actual App Password!");
    // }
    
    $len = strlen($config['smtpPassword']);
    echo "Password Length: " . $len . " chars\n";
    // if ($len !== 16) {
    //    echo "⚠️ WARNING: Password length is $len. Google App Passwords are exactly 16 characters.\n";
    //    echo "   You might have pasted the wrong code or included extra spaces/characters.\n";
    // }

    echo "\n<b>Attempting SMTP Connection...</b>\n";
    
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_CONNECTION; // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host       = $config['smtpHost'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['smtpUsername'];
    $mail->Password   = $config['smtpPassword'];
    $mail->SMTPSecure = $config['smtpSecure'];
    $mail->Port       = $config['smtpPort'];

    // Recipients
    $mail->setFrom($config['smtpUsername'], 'SMTP Tester');
    $mail->addAddress($config['smtpUsername']); // Send to self

    // Content
    $mail->isHTML(false);
    $mail->Subject = 'SMTP Test - ' . date('Y-m-d H:i:s');
    $mail->Body    = 'If you received this, your SMTP configuration is CORRECT.';

    $mail->send();
    echo "\n<span style='color:green; font-weight:bold; font-size:1.2em'>✅ SUCCESS: Email sent successfully!</span>\n";
    echo "Check your inbox at " . $config['smtpUsername'];

} catch (Exception $e) {
    echo "\n<span style='color:red; font-weight:bold; font-size:1.2em'>❌ FAILED: " . $e->getMessage() . "</span>\n";
    if (isset($mail)) {
         echo "Mailer Error: " . $mail->ErrorInfo . "\n";
    }
    
    echo "\n<b>Troubleshooting Tips:</b>\n";
    echo "1. Did you enable 2-Step Verification in Google Account?\n";
    echo "2. Did you generate an 'App Password' (NOT your login password)?\n";
    echo "3. Did you copy the App Password correctly into Mailer.php?\n";
}

echo "</pre>";
