<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';

if (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: /Software-Services/admin/dashboard.php');
} else {
    header('Location: /Software-Services/admin/login.php');
}
exit;
