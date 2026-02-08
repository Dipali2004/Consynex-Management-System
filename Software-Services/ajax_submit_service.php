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

use TrainingApp\App\Models\ServiceRequest;
use TrainingApp\App\Mailer;

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'type' => 'danger', 'message' => 'Invalid request method.']);
    exit;
}

try {
    // 1. Retrieve and Sanitize Input
    // Note: In services.php form, the select name is 'reference_name', we map it to 'service_name'
    $service_name = trim($_POST['reference_name'] ?? ''); 
    $name = trim($_POST['name'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // 2. Validate
    if (empty($service_name) || empty($name) || empty($mobile)) {
        echo json_encode(['success' => false, 'type' => 'danger', 'message' => 'Please fill in all required fields.']);
        exit;
    }

    // 3. Save to Database (service_requests table)
    $requestId = ServiceRequest::create([
        'service_name' => $service_name,
        'name' => $name,
        'mobile' => $mobile,
        'email' => $email,
        'message' => $message
    ]);
    
    if ($requestId) {
        debug_log("Service Request Created. ID: " . $requestId);

        // 4. Send Email using Secure Mailer
        $mailer = new Mailer();
        $mailSent = $mailer->sendServiceRequest([
            'service_name' => $service_name,
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'message' => $message
        ]);

        if ($mailSent) {
            debug_log("Service Request Email Sent Successfully.");
            echo json_encode([
                'success' => true, 
                'type' => 'success', 
                'message' => 'Service request submitted successfully'
            ]);
        } else {
            debug_log("Email Sending Failed via Mailer. Logs: \n" . $mailer->getLogs());
            // DB Save succeeded, so we return SUCCESS to the user, but log the email error.
            echo json_encode([
                'success' => true, 
                'type' => 'warning', 
                'message' => 'Service request submitted, but email could not be sent'
            ]);
        }
    } else {
        debug_log("Database Insert Failed (ID is 0).");
        echo json_encode([
            'success' => false, 
            'type' => 'danger', 
            'message' => 'Something went wrong. Please try again later.'
        ]);
    }

} catch (Exception $e) {
    debug_log("Exception: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'type' => 'danger', 
        'message' => 'Something went wrong. Please try again later.'
    ]);
}
