<?php
require_once __DIR__ . '/bootstrap.php';
use TrainingApp\App\Database;

require_login();

$pdo = Database::conn();
$action = $_GET['action'] ?? 'list';
$tab = $_GET['tab'] ?? 'manage';
$error = '';
$success = '';

// Handle Service Requests Actions
if ($tab === 'requests' && !empty($_GET['id'])) {
    if ($action === 'update_status' && !empty($_GET['status'])) {
        $stmt = $pdo->prepare("UPDATE service_requests SET status = ? WHERE id = ?");
        $stmt->execute([$_GET['status'], $_GET['id']]);
        header('Location: services.php?tab=requests&msg=Status updated successfully');
        exit;
    }
    if ($action === 'delete_request') {
        $stmt = $pdo->prepare("DELETE FROM service_requests WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        header('Location: services.php?tab=requests&msg=Request deleted successfully');
        exit;
    }
}

// Handle Form Submission (Manage Services)
$service = null; // Initialize variable for form re-population

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $tab === 'manage') {
    $id = $_POST['id'] ?? null;
    $category = trim($_POST['category']);
    $service_name = trim($_POST['service_name']);
    $description = trim($_POST['description']);
    $icon = trim($_POST['icon']);
    $status = isset($_POST['status']) ? 1 : 0;
    
    if (empty($category) || empty($service_name)) {
        $error = "Category and Service Name are required.";
        // Set action and service data to re-render form with user input
        $action = $id ? 'edit' : 'add';
        $service = [
            'id' => $id,
            'category' => $category,
            'service_name' => $service_name,
            'description' => $description,
            'icon' => $icon,
            'status' => $status
        ];
    } else {
        if ($id) {
            // Update
            $stmt = $pdo->prepare("UPDATE services SET category=?, service_name=?, description=?, icon=?, status=? WHERE id=?");
            $stmt->execute([$category, $service_name, $description, $icon, $status, $id]);
            $msg = "Service updated successfully.";
        } else {
            // Create
            $stmt = $pdo->prepare("INSERT INTO services (category, service_name, description, icon, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$category, $service_name, $description, $icon, $status]);
            $msg = "Service created successfully.";
        }
        header("Location: services.php?msg=" . urlencode($msg));
        exit;
    }
}

// Handle Actions (Manage Services)
if ($action === 'delete' && !empty($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header('Location: services.php?msg=Service deleted successfully');
    exit;
}

if ($action === 'toggle_status' && !empty($_GET['id']) && isset($_GET['status'])) {
    $stmt = $pdo->prepare("UPDATE services SET status = ? WHERE id = ?");
    $stmt->execute([$_GET['status'], $_GET['id']]);
    header('Location: services.php?msg=Status updated successfully');
    exit;
}

// Render Views
if ($action === 'add' || $action === 'edit') {
    // If service is not set (from failed POST), and it's an edit, fetch from DB
    if (!isset($service) && $action === 'edit' && !empty($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $service = $stmt->fetch();
    }
    
    admin_view('services_form', [
        'title' => ($action === 'edit' ? 'Edit Service' : 'Add New Service'),
        'service' => $service,
        'error' => $error
    ]);
} else {
    // List View (Tabs)
    
    // Fetch Services
    $stmt = $pdo->query("SELECT * FROM services ORDER BY category, service_name");
    $services = $stmt->fetchAll();
    
    // Fetch Requests
    $status_filter = $_GET['status_filter'] ?? '';
    $req_sql = "SELECT * FROM service_requests";
    $params = [];
    if (!empty($status_filter)) {
        $req_sql .= " WHERE status = ?";
        $params[] = $status_filter;
    }
    $req_sql .= " ORDER BY created_at DESC";
    $stmt = $pdo->prepare($req_sql);
    $stmt->execute($params);
    $requests = $stmt->fetchAll();
    
    // Count pending requests for badge
    $pending_count = $pdo->query("SELECT COUNT(*) FROM service_requests WHERE status = 'Pending'")->fetchColumn();
    
    admin_view('services_tabs', [
        'title' => 'Services Management',
        'active_tab' => $tab,
        'services' => $services,
        'requests' => $requests,
        'pending_count' => $pending_count,
        'msg' => $_GET['msg'] ?? '',
        'error' => $error
    ]);
}
