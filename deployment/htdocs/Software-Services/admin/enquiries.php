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
        $msg = 'Status updated successfully.';
    }
}

// Filters
$date_filter = $_GET['date'] ?? '';
$type_filter = $_GET['type'] ?? '';

$filters = [];
if ($date_filter) {
    $filters['date'] = $date_filter;
}
if ($type_filter) {
    $filters['type'] = $type_filter;
}

$list = Enquiry::filter($filters);

$content = admin_render('enquiries', [
    'list' => $list, 
    'msg' => $msg,
    'date_filter' => $date_filter,
    'type_filter' => $type_filter
]);
admin_view('enquiries', ['content' => $content, 'title' => 'Manage Enquiries']);
