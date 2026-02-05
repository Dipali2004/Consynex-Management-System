<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';
require_login();

use TrainingApp\App\Database;
use TrainingApp\App\Models\TrainingProgram;

function slugify_t(string $text): string {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    return $text ?: uniqid('training-');
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'create') {
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $slug = $slug ?: slugify_t($name);
        TrainingProgram::create([
            'name' => $name,
            'slug' => $slug,
            'description' => trim($_POST['description'] ?? ''),
            'status' => (int)($_POST['status'] ?? 1),
        ]);
        $msg = 'Created';
    } elseif ($action === 'update') {
        $id = (int)$_POST['id'];
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $slug = $slug ?: slugify_t($name);
        TrainingProgram::update($id, [
            'name' => $name,
            'slug' => $slug,
            'description' => trim($_POST['description'] ?? ''),
            'status' => (int)($_POST['status'] ?? 1),
        ]);
        $msg = 'Updated';
    } elseif ($action === 'delete') {
        TrainingProgram::delete((int)$_POST['id']);
        $msg = 'Deleted';
    }
}

$db = Database::conn();
$list = $db->query('SELECT id, name, slug, description, status FROM training_programs ORDER BY id DESC')->fetchAll();

$content = admin_render('trainings', ['list' => $list, 'msg' => $msg]);
admin_view('trainings', ['content' => $content, 'title' => 'Manage Training Programs']);

