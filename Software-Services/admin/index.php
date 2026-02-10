<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';

// Always redirect to login page as the entry point
header('Location: /Software-Services/admin/login.php');
exit;
