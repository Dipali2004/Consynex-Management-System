<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';

use TrainingApp\App\Models\AdminUser;
use TrainingApp\App\Database;

if (!empty($_SESSION['admin_id'])) {
    header('Location: /Software-Services/admin/dashboard.php');
    exit;
}

$db = Database::conn();
$stmtCheck = $db->prepare('SELECT 1 FROM admin_users WHERE username=? LIMIT 1');
$stmtCheck->execute(['admin']);
$exists = $stmtCheck->fetchColumn();
if (!$exists) {
    try {
        $stmtSeed = $db->prepare('INSERT INTO admin_users (username, password_hash, active) VALUES (?, ?, 1)');
        $stmtSeed->execute(['admin', password_hash('admin123', PASSWORD_DEFAULT)]);
    } catch (\PDOException $e) {
        // ignore
    }
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';
    if ($u && $p) {
        $user = AdminUser::findByUsername($u);
        if ($user && ($user['active'] == 1) && password_verify($p, $user['password_hash'])) {
            $_SESSION['admin_id'] = (int)$user['id'];
            $_SESSION['admin_username'] = $user['username'];
            header('Location: /Software-Services/admin/dashboard.php');
            exit;
        }
    }
    $error = 'Invalid credentials';
}

$content = admin_render('login', ['error' => $error]);
admin_view('login', ['content' => $content, 'title' => 'Admin Login']);
