<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';
require_login();

use TrainingApp\App\Models\Enquiry;

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $status = $_POST['status'] ?? '';
    if ($id && $status) {
        Enquiry::updateStatus($id, $status);
        $msg = 'Updated';
    }
}

$list = Enquiry::all();

$content = admin_render('enquiries', ['list' => $list, 'msg' => $msg]);
admin_view('enquiries', ['content' => $content, 'title' => 'Manage Enquiries']);

