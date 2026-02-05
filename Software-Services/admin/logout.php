<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';
session_destroy();
header('Location: /Software-Services/admin/index.php');
exit;

