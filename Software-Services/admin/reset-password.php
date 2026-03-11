<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';

use TrainingApp\App\Database;

// Redirect if already logged in
if (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: /Software-Services/admin/dashboard.php');
    exit;
}

$error = '';
$success = '';
$token = $_GET['token'] ?? ($_POST['token'] ?? '');

if (!$token) {
    header('Location: /Software-Services/admin/login.php');
    exit;
}

try {
    $pdo = Database::conn();
    $stmt = $pdo->prepare("SELECT id FROM admin_users WHERE reset_token = ? AND reset_expiry > NOW() AND active = 1");
    $stmt->execute([$token]);
    $user = $stmt->fetch();
    
    if (!$user) {
        $error = "The password reset link is invalid or has expired. Please request a new one.";
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            
            if ($password && $confirm_password) {
                if ($password === $confirm_password) {
                    if (strlen($password) >= 6) {
                        $hash = password_hash($password, PASSWORD_DEFAULT);
                        $updateStmt = $pdo->prepare("UPDATE admin_users SET password_hash = ?, reset_token = NULL, reset_expiry = NULL, failed_login_attempts = 0, account_locked_until = NULL WHERE id = ?");
                        $updateStmt->execute([$hash, $user['id']]);
                        
                        $success = "Your password has been reset successfully. You can now <a href='/Software-Services/admin/login.php'>Login</a> with your new password.";
                    } else {
                        $error = "Password must be at least 6 characters long.";
                    }
                } else {
                    $error = "Passwords do not match.";
                }
            } else {
                $error = "Please fill in all fields.";
            }
        }
    }
} catch (Exception $e) {
    $error = "Error: " . $e->getMessage();
}

$content = admin_render('reset_password', ['error' => $error, 'success' => $success, 'token' => $token]);
admin_view('reset_password', ['content' => $content, 'title' => 'Reset Password', 'force_login_layout' => true]);
