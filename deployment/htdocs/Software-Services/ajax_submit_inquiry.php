<?php
declare(strict_types=1);

// Enable error logging to a file (Server Side Only)
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/error_log.txt');
ini_set('display_errors', '0'); // Do NOT display errors to user
error_reporting(E_ALL);

// Custom Logger
function debug_log($message) {
    $entry = "[" . date('Y-m-d H:i:s') . "] " . print_r($message, true) . "\n";
    file_put_contents(__DIR__ . '/debug_log.txt', $entry, FILE_APPEND);
}

// Autoload logic
require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($class) {
    $prefix = 'TrainingApp\\App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $rel = substr($class, strlen($prefix));
    $path = __DIR__ . '/../training/app/' . str_replace('\\', '/', $rel) . '.php';
    if (is_file($path)) {
        require $path;
    }
});

use TrainingApp\App\Models\Enquiry;
use TrainingApp\App\Mailer;
use TrainingApp\App\EnvLoader;

// Load environment variables
EnvLoader::load(__DIR__ . '/../.env');

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'type' => 'danger', 'message' => 'Invalid request method.']);
    exit;
}

try {
    // 1. Retrieve and Sanitize Input
    $inquiry_type = trim($_POST['inquiry_type'] ?? '');
    $reference_name = trim($_POST['reference_name'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // 2. Validate
    if (empty($inquiry_type) || empty($reference_name) || empty($name) || empty($mobile)) {
        echo json_encode(['success' => false, 'type' => 'danger', 'message' => 'Please fill in all required fields.']);
        exit;
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'type' => 'danger', 'message' => 'Please enter a valid email address.']);
        exit;
    }

    // 3. Save to Database
    try {
        $enquiryId = Enquiry::create([
            'inquiry_type' => $inquiry_type,
            'reference_name' => $reference_name,
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'message' => $message
        ]);
    } catch (\Throwable $e) {
        debug_log("Database Error: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'type' => 'danger',
            'message' => 'Failed to save inquiry. Please try again.'
        ]);
        exit;
    }
    
    if ($enquiryId) {
        debug_log("Inquiry Created. ID: " . $enquiryId);

        // 4. Send Email using Secure Mailer
        $mailSent = false;
        try {
            $mailer = new Mailer();
            $mailSent = $mailer->sendInquiry([
                'inquiry_type' => $inquiry_type,
                'reference_name' => $reference_name,
                'name' => $name,
                'mobile' => $mobile,
                'email' => $email,
                'message' => $message
            ]);
        } catch (\Throwable $e) {
            debug_log("Mailer Initialization Failed: " . $e->getMessage());
        }

        if ($mailSent) {
            debug_log("Email Sent Successfully.");
            echo json_encode([
                'success' => true, 
                'type' => 'success', 
                'message' => 'Thank you! Your inquiry has been sent successfully. Our team will contact you shortly.'
            ]);
        } else {
            debug_log("Email Sending Failed.");
            // DB Save succeeded, so we return SUCCESS to the user, but log the email error.
            echo json_encode([
                'success' => true, 
                'type' => 'success', // Keep it success for the user as the inquiry is saved
                'message' => 'Thank you! Your inquiry has been sent successfully. Our team will contact you shortly.'
            ]);
        }
    } else {
        debug_log("Database Insert Failed (ID is 0).");
        echo json_encode([
            'success' => false, 
            'type' => 'danger', 
            'message' => 'Something went wrong while saving your inquiry. Please try again later.'
        ]);
    }

} catch (\Throwable $e) {
    debug_log("Fatal Error: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'type' => 'danger', 
        'message' => 'An unexpected error occurred. Please try again later.'
    ]);
}
