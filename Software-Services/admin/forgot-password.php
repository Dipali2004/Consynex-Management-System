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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    
    if ($email) {
        try {
            $pdo = Database::conn();
            $stmt = $pdo->prepare("SELECT id FROM admin_users WHERE email = ? AND active = 1");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user) {
                // Generate reset token
                $token = bin2hex(random_bytes(32));
                $expiry = date('Y-m-d H:i:s', time() + 3600); // 1 hour expiry
                
                $updateStmt = $pdo->prepare("UPDATE admin_users SET reset_token = ?, reset_expiry = ? WHERE id = ?");
                $updateStmt->execute([$token, $expiry, $user['id']]);
                
                // In a real application, you would send an email here.
                // For this project, we'll simulate it by showing the reset link or logging it.
                $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/Software-Services/admin/reset-password.php?token=" . $token;
                
                // Log the link for debug/demo
                error_log("Password reset link for " . $email . ": " . $reset_link);
                
                $success = "If your email is registered, you will receive a reset link shortly.";
                // Demo purpose only: display the link (not for production)
                $success .= " (Demo: <a href='" . $reset_link . "'>Reset Password Link</a>)";
            } else {
                // To prevent email enumeration, we show the same success message
                $success = "If your email is registered, you will receive a reset link shortly.";
            }
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "Please enter your email address.";
    }
}

$content = admin_render('forgot_password', ['error' => $error, 'success' => $success]);
admin_view('forgot_password', ['content' => $content, 'title' => 'Forgot Password', 'force_login_layout' => true]);
