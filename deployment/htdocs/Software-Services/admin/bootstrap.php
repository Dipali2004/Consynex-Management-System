<?php
declare(strict_types=1);

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
ini_set('display_errors', '0');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_strict_mode', '1');

session_start();

// CSRF Protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
