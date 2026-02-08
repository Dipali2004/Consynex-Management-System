<?php
// Simulate a POST request to ajax_submit_service.php

$url = 'http://localhost:8000/Software-Services/ajax_submit_service.php';
// Allow command line arguments for testing dynamic input
$name = $argv[1] ?? 'Dynamic User';
$message = $argv[2] ?? 'This is a dynamic test request.';

$data = [
    'reference_name' => 'Web Development', // Maps to service_name
    'name' => $name,
    'mobile' => '08010331634',
    'email' => 'dynamic@example.com',
    'message' => $message
];

// Use curl to simulate POST
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response: $response\n";

// Check database directly
require_once __DIR__ . '/training/app/Models/ServiceRequest.php';
require_once __DIR__ . '/training/app/Database.php';

// Manual Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'TrainingApp\\App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $rel = substr($class, strlen($prefix));
    $path = __DIR__ . '/training/app/' . str_replace('\\', '/', $rel) . '.php';
    if (is_file($path)) {
        require $path;
    }
});

use TrainingApp\App\Models\ServiceRequest;

try {
    $requests = ServiceRequest::getAll();
    echo "\nLatest Service Request in DB:\n";
    if (!empty($requests)) {
        print_r($requests[0]);
    } else {
        echo "No requests found in DB.\n";
    }
} catch (Exception $e) {
    echo "DB Error: " . $e->getMessage() . "\n";
}
