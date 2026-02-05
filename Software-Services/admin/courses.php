<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';
require_login();

use TrainingApp\App\Database;
use TrainingApp\App\Models\Course;

function slugify(string $text): string {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    return $text ?: uniqid('course-');
}

$pdo = Database::conn();
try { $pdo->exec('ALTER TABLE courses ADD COLUMN level VARCHAR(32) DEFAULT NULL'); } catch (\PDOException $e) {}
try { $pdo->exec('ALTER TABLE courses ADD COLUMN image_path VARCHAR(512) DEFAULT NULL'); } catch (\PDOException $e) {}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'create') {
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $slug = $slug ?: slugify($name);
        $level = trim($_POST['level'] ?? '');
        $imagePath = null;
        if (!empty($_FILES['image']['name'])) {
            $f = $_FILES['image'];
            if ($f['error'] === UPLOAD_ERR_OK) {
                $allowed = ['image/jpeg','image/png','image/webp'];
                $mime = mime_content_type($f['tmp_name']);
                if (in_array($mime, $allowed, true) && $f['size'] <= 2*1024*1024) {
                    $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
                    $ext = strtolower($ext);
                    if (!in_array($ext, ['jpg','jpeg','png','webp'], true)) { $ext = 'jpg'; }
                    $dir = dirname(__DIR__, 2) . '/training/uploads/courses';
                    if (!is_dir($dir)) { mkdir($dir, 0777, true); }
                    $fname = uniqid('course_', true) . '.' . $ext;
                    $dest = $dir . '/' . $fname;
                    if (move_uploaded_file($f['tmp_name'], $dest)) {
                        $imagePath = '/training/uploads/courses/' . $fname;
                    }
                }
            }
        }
        Course::create([
            'name' => $name,
            'slug' => $slug,
            'duration' => trim($_POST['duration'] ?? ''),
            'level' => $level,
            'image_path' => $imagePath,
            'fees' => trim($_POST['fees'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'status' => (int)($_POST['status'] ?? 1),
            'featured' => (int)($_POST['featured'] ?? 0),
        ]);
        $msg = 'Created';
    } elseif ($action === 'update') {
        $id = (int)$_POST['id'];
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $slug = $slug ?: slugify($name);
        $level = trim($_POST['level'] ?? '');
        $imagePath = trim($_POST['current_image'] ?? '');
        if (!empty($_FILES['image']['name'])) {
            $f = $_FILES['image'];
            if ($f['error'] === UPLOAD_ERR_OK) {
                $allowed = ['image/jpeg','image/png','image/webp'];
                $mime = mime_content_type($f['tmp_name']);
                if (in_array($mime, $allowed, true) && $f['size'] <= 2*1024*1024) {
                    $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
                    $ext = strtolower($ext);
                    if (!in_array($ext, ['jpg','jpeg','png','webp'], true)) { $ext = 'jpg'; }
                    $dir = dirname(__DIR__) . '/training/uploads/courses';
                    if (!is_dir($dir)) { mkdir($dir, 0777, true); }
                    $fname = uniqid('course_', true) . '.' . $ext;
                    $dest = $dir . '/' . $fname;
                    if (move_uploaded_file($f['tmp_name'], $dest)) {
                        $imagePath = '/training/uploads/courses/' . $fname;
                    }
                }
            }
        }
        Course::update($id, [
            'name' => $name,
            'slug' => $slug,
            'duration' => trim($_POST['duration'] ?? ''),
            'level' => $level,
            'image_path' => $imagePath,
            'fees' => trim($_POST['fees'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'status' => (int)($_POST['status'] ?? 1),
            'featured' => (int)($_POST['featured'] ?? 0),
        ]);
        $msg = 'Updated';
    } elseif ($action === 'delete') {
        Course::delete((int)$_POST['id']);
        $msg = 'Deleted';
    }
}

$db = Database::conn();
$list = $db->query('SELECT id, name, slug, duration, level, image_path, fees, description, status, featured FROM courses ORDER BY id DESC')->fetchAll();

$content = admin_render('courses', ['list' => $list, 'msg' => $msg]);
admin_view('courses', ['content' => $content, 'title' => 'Manage Courses']);
