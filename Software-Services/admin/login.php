<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';

use TrainingApp\App\Models\AdminUser;
use TrainingApp\App\Database;

// 1. Redirect if already logged in
if (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: /Software-Services/admin/dashboard.php');
    exit;
}

// Ensure Database and Default Admin Exist
try {
    $db = Database::conn();
    // Check if table exists (simplified check by selecting)
    $stmtCheck = $db->prepare('SELECT 1 FROM admin_users WHERE username=? LIMIT 1');
    $stmtCheck->execute(['admin']);
    $exists = $stmtCheck->fetchColumn();
    
    if (!$exists) {
        // Seed default admin if not exists (admin / admin123)
        $stmtSeed = $db->prepare('INSERT INTO admin_users (username, password_hash, active) VALUES (?, ?, 1)');
        $stmtSeed->execute(['admin', password_hash('admin123', PASSWORD_DEFAULT)]);
    }
} catch (\PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
}

$error = '';

// 2. Handle Login POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // CSRF Check
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $error = 'Invalid Security Token (CSRF)';
        } else {
            $u = trim($_POST['username'] ?? '');
            $p = $_POST['password'] ?? '';
            
            if ($u && $p) {
                $user = AdminUser::findByUsername($u);
                
                if ($user) {
                    // Check if account is locked
                    if (!empty($user['account_locked_until']) && strtotime($user['account_locked_until']) > time()) {
                        $unlockTime = strtotime($user['account_locked_until']);
                        $minutes = ceil(($unlockTime - time()) / 60);
                        $error = "Account locked due to too many failed attempts. Try again in $minutes minutes.";
                    } else {
                        // Verify Password
                        if (($user['active'] == 1) && password_verify($p, $user['password_hash'])) {
                            // SUCCESSFUL LOGIN
                            
                            // Reset failed attempts
                            $db->prepare("UPDATE admin_users SET failed_login_attempts = 0, account_locked_until = NULL, last_failed_login = NULL WHERE id = ?")
                               ->execute([$user['id']]);

                            // 3. Security Hardening: Regenerate Session ID
                            // Note: We use false here for staging compatibility to avoid losing session if delete fails
                            session_regenerate_id(false);
                            
                            // 4. Set Session Variables
                            $_SESSION['admin_logged_in'] = true;
                            $_SESSION['admin_id'] = (int)$user['id'];
                            $_SESSION['admin_username'] = $user['username'];
                            $_SESSION['login_time'] = time();
                            $_SESSION['last_activity'] = time(); // For inactivity timeout
                            
                            // Redirect to Dashboard
                            header('Location: /Software-Services/admin/dashboard.php');
                            exit;
                        } else {
                            // FAILED LOGIN
                            $attempts = (int)($user['failed_login_attempts'] ?? 0) + 1;
                            $lockUntil = null;
                            
                            if ($attempts >= 5) {
                                $lockUntil = date('Y-m-d H:i:s', time() + 900); // Lock for 15 mins
                                $error = 'Account locked for 15 minutes due to too many failed attempts.';
                            } else {
                                $error = 'Invalid credentials';
                            }
                            
                            $db->prepare("UPDATE admin_users SET failed_login_attempts = ?, last_failed_login = NOW(), account_locked_until = ? WHERE id = ?")
                               ->execute([$attempts, $lockUntil, $user['id']]);
                        }
                    }
                } else {
                    // User not found
                    $error = 'Invalid credentials';
                }
            } else {
                $error = 'Please enter username and password';
            }
        }
    } catch (\Exception $e) {
        // Catch DB errors during login
        $error = 'Login Error: ' . $e->getMessage();
        error_log($error);
    }
}

// 5. Render Login View
$content = admin_render('login', ['error' => $error]);
admin_view('login', ['content' => $content, 'title' => 'Admin Login', 'force_login_layout' => true]);
