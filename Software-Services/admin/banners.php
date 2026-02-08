<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';
require_login();

use TrainingApp\App\Models\Banner;

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'create') {
        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../images/banner/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $filename = basename($_FILES['image']['name']);
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            
            if (in_array($ext, $allowed)) {
                $newFileName = uniqid('banner_') . '.' . $ext;
                $destPath = $uploadDir . $newFileName;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $destPath)) {
                    $imagePath = 'images/banner/' . $newFileName;
                }
            }
        }

        if ($imagePath) {
            Banner::create([
                'title' => trim($_POST['title'] ?? ''),
                'image_path' => $imagePath,
                'link_url' => trim($_POST['link_url'] ?? ''),
                'status' => (int)($_POST['status'] ?? 1),
                'sort_order' => (int)($_POST['sort_order'] ?? 0),
            ]);
            $msg = 'Created successfully';
        } else {
            $msg = 'Failed to upload image. Please check file type and permissions.';
        }
    } elseif ($action === 'update') {
        Banner::update((int)$_POST['id'], [
            'title' => trim($_POST['title'] ?? ''),
            'image_path' => trim($_POST['image_path'] ?? ''),
            'link_url' => trim($_POST['link_url'] ?? ''),
            'status' => (int)($_POST['status'] ?? 1),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
        ]);
        $msg = 'Updated';
    } elseif ($action === 'delete') {
        Banner::delete((int)$_POST['id']);
        $msg = 'Deleted';
    }
}

$list = Banner::allActive();

$content = admin_render('banners', ['list' => $list, 'msg' => $msg]);
admin_view('banners', ['content' => $content, 'title' => 'Manage Banners']);

