<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';
require_login();

use TrainingApp\App\Models\Banner;

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'create') {
        Banner::create([
            'title' => trim($_POST['title'] ?? ''),
            'image_path' => trim($_POST['image_path'] ?? ''),
            'link_url' => trim($_POST['link_url'] ?? ''),
            'status' => (int)($_POST['status'] ?? 1),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
        ]);
        $msg = 'Created';
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

