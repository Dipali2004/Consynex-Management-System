<?php
require_once __DIR__ . '/bootstrap.php';
use TrainingApp\App\Database;

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$pdo = Database::conn();
$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';
$id = $input['id'] ?? null;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

try {
    if ($action === 'toggle_status') {
        $status = $input['status'] ?? null;
        if (!isset($status)) {
            throw new Exception('Status required');
        }
        
        $stmt = $pdo->prepare("UPDATE services SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        
        echo json_encode(['success' => true, 'message' => 'Status updated successfully', 'new_status' => $status]);
        exit;
    }
    
    if ($action === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
        $stmt->execute([$id]);
        
        echo json_encode(['success' => true, 'message' => 'Service deleted successfully']);
        exit;
    }
    
    echo json_encode(['success' => false, 'message' => 'Invalid action']);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
