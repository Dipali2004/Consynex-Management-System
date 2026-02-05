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

session_start();

function admin_view(string $name, array $vars = []): void
{
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
    if (empty($_SESSION['admin_id'])) {
        header('Location: /Software-Services/admin/index.php');
        exit;
    }
}

