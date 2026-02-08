<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$course_id = $input['course_id'] ?? null;
$type = $input['type'] ?? 'WhatsApp';

if (!$course_id) {
    echo json_encode(['success' => false, 'message' => 'Missing course ID']);
    exit;
}

try {
    $pdo = Database::conn();
    $stmt = $pdo->prepare("INSERT INTO course_inquiries (course_id, inquiry_type) VALUES (?, ?)");
    $stmt->execute([$course_id, $type]);
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Log error if needed
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>
