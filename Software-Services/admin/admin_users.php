<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';
require_login();

use TrainingApp\App\Database;
use TrainingApp\App\Models\AdminUser;

$db = Database::conn();
$msg = '';
$error = '';

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'create') {
        $u = trim($_POST['username'] ?? '');
        $p = $_POST['password'] ?? '';

        if ($u && $p) {
            $stmtCheck = $db->prepare('SELECT 1 FROM admin_users WHERE username=? LIMIT 1');
            $stmtCheck->execute([$u]);
            if ($stmtCheck->fetchColumn()) {
                $error = "Username already exists.";
            } else {
                // Here we store BOTH the secure hash for PHP logins AND an encrypted version using
                // a secret key so the admin can decrypt and view it later.
                $hash = password_hash($p, PASSWORD_DEFAULT);
                $key = "ConsynexSecretKey123!"; // Simple symmetric key for this feature
                $cipher = "aes-256-cbc";
                $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
                $encrypted = openssl_encrypt($p, $cipher, $key, 0, $iv);
                $stored_encrypted = base64_encode($iv . $encrypted);

                try {
                    // Make sure the column exists first
                    try {
                        $db->exec("ALTER TABLE admin_users ADD COLUMN stored_password VARCHAR(255) NULL AFTER password_hash");
                    } catch (\Exception $e) {
                    } // Ignore if already exists

                    $stmt = $db->prepare('INSERT INTO admin_users (username, password_hash, stored_password, active) VALUES (?, ?, ?, 1)');
                    $stmt->execute([$u, $hash, $stored_encrypted]);
                    $msg = "User created successfully.";
                } catch (\PDOException $e) {
                    $error = "Database Error: " . $e->getMessage();
                }
            }
        } else {
            $error = "Username and password required.";
        }
    } elseif ($action === 'verify_password') {
        // Admin is trying to view a user's password
        $admin_id = $_SESSION['admin_id'];
        $admin_pwd = $_POST['admin_password'] ?? '';
        $target_user_id = (int) ($_POST['target_user_id'] ?? 0);

        // Verify current admin password
        $stmt = $db->prepare('SELECT password_hash FROM admin_users WHERE id = ?');
        $stmt->execute([$admin_id]);
        $admin_hash = $stmt->fetchColumn();

        if (password_verify($admin_pwd, $admin_hash)) {
            // Admin authenticated, fetch target user's encrypted password
            $stmt = $db->prepare('SELECT stored_password FROM admin_users WHERE id = ?');
            $stmt->execute([$target_user_id]);
            $stored = $stmt->fetchColumn();

            if ($stored) {
                // Decrypt it
                $key = "ConsynexSecretKey123!";
                $cipher = "aes-256-cbc";
                $data = base64_decode($stored);
                $ivlen = openssl_cipher_iv_length($cipher);
                $iv = substr($data, 0, $ivlen);
                $encrypted = substr($data, $ivlen);
                $decrypted = openssl_decrypt($encrypted, $cipher, $key, 0, $iv);

                $_SESSION['revealed_passwords'][$target_user_id] = $decrypted;
            } else {
                $error = "No viewable password stored for this old user.";
            }
        } else {
            $error = "Incorrect Admin Password. Verification failed.";
        }
    } elseif ($action === 'hide_password') {
        $target_user_id = (int) ($_POST['target_user_id'] ?? 0);
        unset($_SESSION['revealed_passwords'][$target_user_id]);
    } elseif ($action === 'delete') {
        // Prevent deleting self
        $target_id = (int) ($_POST['id'] ?? 0);
        if ($target_id === $_SESSION['admin_id']) {
            $error = "You cannot delete your own account.";
        } else {
            $db->prepare('DELETE FROM admin_users WHERE id = ?')->execute([$target_id]);
            $msg = "User deleted.";
        }
    }
}

// Fetch all users
$users = $db->query('SELECT id, username, active, failed_login_attempts, created_at FROM admin_users ORDER BY id ASC')->fetchAll();

$content = admin_render('admin_users', [
    'users' => $users,
    'msg' => $msg,
    'error' => $error
]);
admin_view('admin_users', ['content' => $content, 'title' => 'Manage Admin Users']);
