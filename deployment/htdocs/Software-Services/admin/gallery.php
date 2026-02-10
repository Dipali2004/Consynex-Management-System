<?php
require_once __DIR__ . '/bootstrap.php';
use TrainingApp\App\Database;

require_login();

$pdo = Database::conn();
$action = $_GET['action'] ?? 'list';
$error = '';
$msg = $_GET['msg'] ?? '';

// Helper to handle file upload
function handle_gallery_image_upload($file) {
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            // Validate size (5MB for high quality images)
            if ($file['size'] <= 5 * 1024 * 1024) {
                $uploadDir = '../uploads/gallery/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $filename = uniqid('gallery_') . '.' . $ext;
                $destination = $uploadDir . $filename;
                
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return 'uploads/gallery/' . $filename;
                }
            }
        }
    }
    return null;
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'add' || $action === 'edit') {
        $id = $_POST['id'] ?? null;
        $title = trim($_POST['title']);
        $category = trim($_POST['category']);
        $status = isset($_POST['status']) ? 1 : 0;
        
        // Image processing
        $image_path = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_path = handle_gallery_image_upload($_FILES['image']);
        } elseif ($action === 'edit' && isset($_POST['existing_image'])) {
            $image_path = $_POST['existing_image'];
        }
        
        // Validation
        if (empty($category)) {
            $error = "Category is required.";
        } elseif ($action === 'add' && !$image_path) {
            $error = "Image is required for new entries.";
        } else {
            if (empty($error)) {
                if ($id) {
                    // Update
                    if ($image_path) {
                        $stmt = $pdo->prepare("UPDATE gallery SET title=?, category=?, image_path=?, status=? WHERE id=?");
                        $stmt->execute([$title, $category, $image_path, $status, $id]);
                    } else {
                        $stmt = $pdo->prepare("UPDATE gallery SET title=?, category=?, status=? WHERE id=?");
                        $stmt->execute([$title, $category, $status, $id]);
                    }
                    $msg = "Image updated successfully.";
                } else {
                    // Create
                    $stmt = $pdo->prepare("INSERT INTO gallery (title, category, image_path, status) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$title, $category, $image_path, $status]);
                    $msg = "Image added successfully.";
                }
                header("Location: gallery.php?msg=" . urlencode($msg));
                exit;
            }
        }
    }
}

// Handle Actions
if ($action === 'delete' && !empty($_GET['id'])) {
    // Get image path to delete file
    $stmt = $pdo->prepare("SELECT image_path FROM gallery WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $img = $stmt->fetchColumn();
    
    if ($img && file_exists(__DIR__ . '/../' . $img)) {
        unlink(__DIR__ . '/../' . $img);
    }

    $stmt = $pdo->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header('Location: gallery.php?msg=Image deleted successfully');
    exit;
}

if ($action === 'toggle_status' && !empty($_GET['id']) && isset($_GET['status'])) {
    $stmt = $pdo->prepare("UPDATE gallery SET status = ? WHERE id = ?");
    $stmt->execute([$_GET['status'], $_GET['id']]);
    header('Location: gallery.php?msg=Status updated successfully');
    exit;
}

// Load View
if ($action === 'add' || $action === 'edit') {
    $item = null;
    if ($action === 'edit' && !empty($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM gallery WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $item = $stmt->fetch();
    }
    
    $view = 'gallery_form';
    $title = ($action === 'add' ? 'Add' : 'Edit') . ' Gallery Image';
} else {
    $stmt = $pdo->query("SELECT * FROM gallery ORDER BY created_at DESC");
    $gallery_items = $stmt->fetchAll();
    
    $view = 'gallery_list';
    $title = 'Gallery Management';
}

admin_view($view, ['title' => $title, 'gallery_items' => $gallery_items ?? [], 'item' => $item ?? null, 'error' => $error, 'msg' => $msg]);
