<?php
require_once __DIR__ . '/training/app/Config.php';
require_once __DIR__ . '/training/app/Database.php';
require_once __DIR__ . '/training/app/Models/Banner.php';
use TrainingApp\App\Models\Banner;

try {
    // 1. Deactivate all existing banners to ensure the new one takes precedence
    $pdo = \TrainingApp\App\Database::conn();
    $pdo->exec("UPDATE banners SET status = 0");
    
    // 2. Add the new banner
    $bannerId = Banner::create([
        'title' => 'Main Slider Image',
        'image_path' => 'images/banner/sliderImage.jpg',
        'link_url' => '',
        'status' => 1,
        'sort_order' => 0
    ]);
    
    echo "Successfully added banner ID: $bannerId\n";
    echo "Path: images/banner/sliderImage.jpg\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
