<?php
require_once __DIR__ . '/../training/app/Config.php';
require_once __DIR__ . '/../training/app/Database.php';

use TrainingApp\App\Database;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

try {
    $pdo = Database::conn();
    
    // Validate inputs
    $customer_name = trim($_POST['customer_name'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $service_name = trim($_POST['service_name'] ?? '');
    $service_id = !empty($_POST['service_id']) ? (int)$_POST['service_id'] : NULL;
    $address = trim($_POST['address'] ?? '');
    $preferred_date = trim($_POST['preferred_date'] ?? '');
    $preferred_time = trim($_POST['preferred_time'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($customer_name) || empty($mobile) || empty($service_name) || empty($address) || empty($preferred_date) || empty($preferred_time)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit;
    }
    
    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO service_requests (service_id, service_name, customer_name, mobile, email, address, preferred_date, preferred_time, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute([
        $service_id,
        $service_name,
        $customer_name,
        $mobile,
        $email,
        $address,
        $preferred_date,
        $preferred_time,
        $message
    ]);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Your service request has been submitted successfully! We will contact you shortly.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error. Please try again.']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
