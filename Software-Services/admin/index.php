<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';

// If someone specifically visits the /admin root URL, forcibly log them out.
// This ensures they ALWAYS see the login screen and have to login again.
$_SESSION = [];
session_destroy();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    setcookie(session_name(), '', time() - 42000, '/');
}

// Always redirect to login page as the entry point
header('Location: /Software-Services/admin/login.php');
exit;
