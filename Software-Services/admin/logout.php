<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';

// 1. Unset all session variables
$_SESSION = [];

// 2. Destroy the session
session_destroy();

// 3. Delete session cookie aggressively
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();

    // Delete for current path
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

    // Fallback: forcefully delete for root path
    setcookie(session_name(), '', time() - 42000, '/');
}

// 4. Redirect to login page
header('Location: /Software-Services/admin/login.php');
exit;
