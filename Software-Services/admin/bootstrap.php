<?php
declare(strict_types=1);

// Prevent "headers already sent" issues on shared hosting
ob_start();

spl_autoload_register(function ($class) {
    $prefix = 'TrainingApp\\App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $rel = substr($class, strlen($prefix));
    $path = __DIR__ . '/../../training/app/' . str_replace('\\', '/', $rel) . '.php';
    if (is_file($path)) {
        require $path;
    }
});

// Load configuration
$config_path = __DIR__ . '/../includes/config.php';
if (file_exists($config_path)) {
    require_once $config_path;
}

// Security Hardening
if (getenv('APP_ENV') === 'production') {
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
} else {
    ini_set('display_errors', '1');
}

// Session Security
$session_path = __DIR__ . '/../../sessions';
if (!is_dir($session_path)) {
    mkdir($session_path, 0700, true);
}
session_save_path($session_path);

ini_set('session.cookie_httponly', '1');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_samesite', 'Lax');
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', '1');
}

session_start();

// Security Headers
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");

// CSRF Protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Global CSRF Middleware for POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Skip CSRF for login page (it has its own check or needs to set the token)
    $current_page = basename($_SERVER['PHP_SELF']);
    if ($current_page !== 'login.php') {
        if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            header('HTTP/1.1 403 Forbidden');
            die("<h1>403 Forbidden</h1><p>CSRF token validation failed. Please refresh the page and try again.</p>");
        }
    }
}

function admin_view(string $name, array $vars = []): void
{
    if (!isset($vars['content'])) {
        $vars['content'] = admin_render($name, $vars);
    }
    extract($vars);
    require __DIR__ . '/layout.php';
}

function admin_render(string $tpl, array $vars = []): string
{
    extract($vars);
    ob_start();
    require __DIR__ . '/views/' . $tpl . '.php';
    return ob_get_clean();
}

function require_login(): void
{
    if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: /Software-Services/admin/login.php');
        exit;
    }
    
    // Session Inactivity Timeout (30 minutes)
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        session_unset();
        session_destroy();
        header('Location: /Software-Services/admin/login.php?timeout=1');
        exit;
    }
    $_SESSION['last_activity'] = time();
}
