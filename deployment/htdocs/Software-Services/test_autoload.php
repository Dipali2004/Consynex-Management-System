<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($class) {
    echo "Attempting to load: $class\n";
    $prefix = 'TrainingApp\\App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $rel = substr($class, strlen($prefix));
    $path = __DIR__ . '/../training/app/' . str_replace('\\', '/', $rel) . '.php';
    echo "Calculated path: $path\n";
    if (is_file($path)) {
        echo "File found.\n";
        require $path;
    } else {
        echo "File NOT found.\n";
    }
});

use TrainingApp\App\Models\ServiceRequest;

try {
    $obj = new ServiceRequest();
    echo "ServiceRequest instantiated successfully.\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
