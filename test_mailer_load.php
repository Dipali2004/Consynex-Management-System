<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/training/app/Mailer.php';

use TrainingApp\App\Mailer;

try {
    $mailer = new Mailer();
    echo "Mailer instantiated successfully.\n";
    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        echo "PHPMailer class found.\n";
    } else {
        echo "PHPMailer class NOT found.\n";
    }
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
